<?php

namespace App\Models\Traits;

trait ByUser 
{
    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user);
    }
}