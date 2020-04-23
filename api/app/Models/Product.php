<?php
 
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use App\Models\User;


 class Product extends Model
 {

    protected $table="products";
    protected $fillable=['title','sub_title','description','price','url_image'];
    

    public function Users(){

      return $this->belongsToMany(User::class,'requests_product')->withPivot('status')->withTimestamps();
    }

 }