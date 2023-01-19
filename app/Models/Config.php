<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Config
 *
 * @property $id
 * @property $configure
 * @property $description
 * @property $val
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Config extends Model
{
    
    static $rules = [
		'configure' => 'required',
		'description' => 'required',
		'val' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['configure','description','val'];



    public static function find($config){
    return self::where('configure', $config)->first()->val;
    }

}
