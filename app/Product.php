<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'ean',
        'price'
    ];

    public function save(array $options=[]) {
        if (empty($this->user_id)) {
            $this->user_id = auth()->user()->id;
        }
        parent::save($options);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
