<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\FormOfPayment;
use App\Models\Entries\ListFormPaymentEntry;
use App\Models\Outputs\ListFormPaymentOutput;

class ListFormPaymentService extends Model
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

    public function __construct(ListFormPaymentEntry $entry){
        $this->entry = $entry;
    }

    public function Process(){
        $query = FormOfPayment::all();

        $list = [];
        foreach($query as $item){
            $list[] = ListFormPaymentOutput::formatOutput($item);
        }

        $this->output = $list;
    }

}

?>