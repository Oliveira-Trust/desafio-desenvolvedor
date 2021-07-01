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
        'slug',
    ];



    
	/**
     * relationships
     *
     * @return void
     */
    public function product() { return $this->hasMany(Product::class, 'category_id', 'id'); }
}
