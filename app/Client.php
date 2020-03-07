<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'phone',
        'address'
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
