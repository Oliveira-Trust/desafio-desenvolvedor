<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Operations;
use App\Models\Coins;
use App\Models\FormOfPayment;
use App\Models\Entries\ListOperationsEntry;
use App\Models\Outputs\ListOperationsOutput;

class ListOperationsService extends Model
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

    public function __construct(ListOperationsEntry $entry){
        $this->entry = $entry;
    }

    public function Process(){
        
        $query = DB::select("   SELECT  op.*,
                                        cs.symbol AS 'symbol_source_coin',
                                        ct.symbol AS 'symbol_target_coin',
                                        fop.name  AS 'name_form_of_payment',
                                        fop.rate  AS 'rate_payment'
                                FROM operations op
                                INNER JOIN coins cs ON cs.id = op.source_currency_id
                                INNER JOIN coins ct ON ct.id = op.target_currency_id
                                INNER JOIN form_of_payments fop ON fop.id = op.form_of_payment_id
                                WHERE op.user_id = :user_id
                                ORDER BY op.id ASC",
                                ["user_id" => $this->entry->user_id]);
        
        $list = [];
        foreach($query as $item){
            $list[] = ListOperationsOutput::formatOutput($item);
        }

        $this->output = $list;
    }

}

?>