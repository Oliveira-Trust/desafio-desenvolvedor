<?php

namespace App\Models\Traits;

trait ByUser 
{

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user);
    }

    public function save(array $options=[]) {
        $this->user_id = auth()->user()->id;
        parent::save($options);
    }

    public static function paginate($limit) {
        return parent::byUser(auth()->user()->id)->paginate($limit);
    }
}