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
        if(!empty($request->productID)){
            return $this->editProducts($request);
        }
        $this->fill([
            "name" => $request->post('name'),
            "price" => $request->post('price'),
            "description" => $request->post('description'),
            "ean" => $request->post('ean'),
        ]);

        $this->save();
        return $this;
    }

    public function editProducts($request){
        $edit = Products::find($request->productID);
        $edit->name = $request->post('name');
        $edit->price = $request->post('price');
        $edit->description = $request->post('description');
        $edit->ean = $request->post('ean');
        if($edit->save()){
            return ["success" => "Produto editado com sucesso!"];
        }
        return ["error" => "Produto não pode ser editado!"];
    }

    private function validate(Request $request){
       $request->validate([
            'name' => 'required',
            'ean' => 'required',
            'price' => 'required'
        ]);
    }

}
