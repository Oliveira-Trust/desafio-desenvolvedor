<?php

namespace App\Models;

class State extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'abbr',
    ];




    
	/**
     * relationships
     *
     * @return void
     */
    public function city() { return $this->hasMany(City::class, 'state_id', 'id'); }

}