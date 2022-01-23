<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Operations;
use App\Models\Coins;
use App\Models\FormOfPayment;
use App\Models\Entries\ConvertCurrencyEntry;
use App\Models\Outputs\ConvertCurrencyOutput;

class ConvertCurrencyService extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "entry",
        "output"
    ];

    public function __construct(ConvertCurrencyEntry $entry){
        $this->entry = $entry;
    }

    public function Process(){
        
        $operation = ConvertCurrencyService::createOperation();

        $info_source_coin = Coins::find($operation->source_currency_id);
        $info_target_coin = Coins::find($operation->target_currency_id);

        $value_to_converted = ConvertCurrencyService::applyFees($operation->value_for_conversion, $operation->form_of_payment_id, $operation);
        $operation->value_for_conversion_minus_rate = $value_to_converted;

        $operation->converted_value = ConvertCurrencyService::convertValue($info_source_coin->symbol, $info_target_coin->symbol,  $operation->value_for_conversion_minus_rate, $operation);
        $operation->save();

        $this->output = ConvertCurrencyService::getResultOperation($operation);
    }

    

    public function applyFees($value, $form_of_payment, $operation){
        $form = FormOfPayment::find($form_of_payment);
        
        $payment_rate = (($value * $form->rate)/100);
        $operation->payment_rate = $payment_rate;

        $conversion_rate = $value < 3000.00 ? (($value*2)/100) : (($value*1)/100);
        $operation->conversion_rate = $conversion_rate;
        $operation->save();

        return $value - $payment_rate - $conversion_rate;
    }

    public function createOperation(){

        $operation = new Operations();
        $operation->value_for_conversion                = $this->entry->value_for_conversion;
        $operation->converted_value                     = 0.0;
        $operation->target_currency_value               = 0.0;
        $operation->payment_rate                        = 0.0;
        $operation->conversion_rate                     = 0.0;
        $operation->value_for_conversion_minus_rate     = 0.0;
        $operation->source_currency_id                  = $this->entry->source_currency_id;
        $operation->target_currency_id                  = $this->entry->target_currency_id;
        $operation->form_of_payment_id                  = $this->entry->form_of_payment_id;
        $operation->user_id                             = $this->entry->user_id;

        $operation->save();
        
        return $operation;
    }


    public function getResultOperation($operation){
        $query = DB::select("   SELECT  op.*,
                                        cs.symbol AS 'symbol_source_coin',
                                        ct.symbol AS 'symbol_target_coin',
                                        fop.name  AS 'name_form_of_payment',
                                        fop.rate  AS 'rate_payment'
                                FROM operations op
                                INNER JOIN coins cs ON cs.id = op.source_currency_id
                                INNER JOIN coins ct ON ct.id = op.target_currency_id
                                INNER JOIN form_of_payments fop ON fop.id = op.form_of_payment_id
                                where op.id = :operation_id",
                                ["operation_id" => $operation->id])[0];

        $output = ConvertCurrencyOutput::formatOutput($query);
        
        return $output;
    }

    
    public function convertValue($source_coin, $target_coin, $value, $operation){

        $reference_source_value = $this->getCurrencyValue($source_coin, $target_coin, $value);
        $value_with_fee = floatval($reference_source_value) * floatval($value);

        $operation->target_currency_value = $this->getCurrencyValue($target_coin, $source_coin, $value);
        $operation->save();

        return $value_with_fee;

    }

    public function getCurrencyValue($source_coin, $target_coin, $value){
        $result = $this->getURL(env("APP_URL_CONVERT_COIN")."/json/last/".$source_coin."-".$target_coin);
        return floatval($result->{$source_coin.$target_coin}->bid);
    }

    public function getURL($url){
        $options =  array('http' => 
                        array(  'header'  => "Content-type: application/json\r\n",
                                'method'  => 'GET',
                                'content' => http_build_query([])
                            )
                    );
        $context  = stream_context_create($options);
        $result = json_decode(file_get_contents($url, false, $context));
        return $result;
    }
}

?>