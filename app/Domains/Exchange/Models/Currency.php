<?php

namespace App\Domains\Exchange\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = "currencies";

    protected $fillable = [
        "description", "code",
    ];

    protected $hidden = [
        "timestamps"
    ];

    public $timestamps = true;

    public function exchanges()
    {
        return $this->hasMany(Exchange::class);
    }
}
