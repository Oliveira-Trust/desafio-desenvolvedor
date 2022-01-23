<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ListCoinsEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "coin_id"
    ];

    public function __construct(Request $entry){
        $this->coin_id = intVal($entry->coin_id);
    }
}



