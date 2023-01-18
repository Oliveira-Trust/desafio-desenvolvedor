<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coin
 *
 * @property $id
 * @property $coin_dest
 * @property $coin_base
 * @property $label
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Coin extends Model
{
    
    static $rules = [
		'coin_dest' => 'required',
		'coin_base' => 'required',
		'label' => 'required',
    ];

    public $timestamps = false;
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['coin_dest','coin_base','label'];



}
