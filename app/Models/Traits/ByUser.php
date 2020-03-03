<?php

namespace App\Models\Traits;

trait ByUser 
{

    public function scopeByAuthorizedUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user);
    }

    public function save(array $options=[]) {
        if (empty($this->user_id)) {
            $this->user_id = auth()->user()->id;
        }
        parent::save($options);
    }

    public static function paginate($limit) {
        return parent::byUser(auth()->user()->id)->paginate($limit);
    }

    public static function get() {
        return parent::byUser(auth()->user()->id)->get();
    }
}