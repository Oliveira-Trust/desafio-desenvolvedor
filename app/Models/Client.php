<?php

namespace App\Models;

use Carbon\Carbon;

class Client extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'document',
        'phone_number',
        'phone_number2',
        'birth',
        'address_zipcode',
        'address_street',
        'address_number',
        'address_complement',
        'address_neighborhood',
        'city_id',
    ];



	/**
     * relationships
     *
     * @return void
     */
	public function user() { return $this->belongsTo(User::class, 'user_id', 'id'); }
	public function city() { return $this->hasOne(City::class, 'id', 'city_id'); }



    /* Mutators */
    public function setBirthAttribute($value){
        $this->attributes['birth'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    } 
}
