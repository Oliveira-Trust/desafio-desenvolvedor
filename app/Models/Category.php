<?php

namespace App\Models;

class Category extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
    ];



    
	/**
     * relationships
     *
     * @return void
     */
    public function product() { return $this->hasMany(Product::class, 'category_id', 'id'); }
}
