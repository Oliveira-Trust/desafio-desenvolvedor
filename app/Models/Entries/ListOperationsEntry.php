<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ListOperationsEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id"
    ];

    public function __construct(Request $entry){
        $this->user_id = intVal($entry->user_id);
    }
}



