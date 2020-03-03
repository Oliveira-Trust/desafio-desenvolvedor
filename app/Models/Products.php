<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name','price','description','ean'];

    public function saveProducts($request)
    {
        $this->validate($request);
        $this->fill([
            "name" => $request->post('name'),
            "price" => $request->post('price'),
            "description" => $request->post('description'),
            "ean" => $request->post('ean'),
        ]);

        $this->save();
        return $this;
    }

    private function validate(Request $request){
       $request->validate([
            'name' => 'required',
            'ean' => 'required',
            'price' => 'required'
        ]);
    }

}
