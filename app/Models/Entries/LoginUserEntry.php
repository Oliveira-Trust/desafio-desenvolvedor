<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LoginUserEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "email",
        "password"
    ];

    public function __construct(Request $entry){
        $this->email    = trim($entry->email);
        $this->password = trim($entry->password);
    }
}



