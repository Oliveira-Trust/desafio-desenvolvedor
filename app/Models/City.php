<?php

namespace App\Models;

class City extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'state_id',
    ];


    
	/**
     * relationships
     *
     * @return void
     */
	public function state() { return $this->belongsTo(State::class, 'state_id', 'id'); }
	public function client() { return $this->belongsTo(Client::class, 'client_id', 'id'); }

}
