<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Coins;
use App\Models\Entries\ListCoinsEntry;
use App\Models\Outputs\ListCoinsOutput;

class ListCoinsService extends Model
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

    public function __construct(ListCoinsEntry $entry){
        $this->entry = $entry;
    }

    public function Process(){
        
        $query = Coins::all();

        $list = [];
        foreach($query as $item){
            $list[] = ListCoinsOutput::formatOutput($item);
        }

        $this->output = $list;
    }

}

?>