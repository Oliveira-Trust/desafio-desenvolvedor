<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Product::orderBy('name')->get());
        /*parse_str($request->data, $dataItems);
        $where = [];
        foreach($dataItems as $field => $value){
            if(trim($value) !=''){
                $where[] = array($field,'=',$value);
            }
        }
        
        if(strstr($request->order, '|')){
            $order = explode('|',$request->order);
            $fieldOrder = (trim($order[0]) != '')? $order[0]: 'name';
            $typeOrder = (trim($order[1]) != '')? $order[1]: 'asc';
        }else{
            $fieldOrder = 'name';
            $typeOrder = 'asc';
        }
        return response()->json(Product::where($where)->orderBy($fieldOrder,$typeOrder)->paginate($request->items));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(Product::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(Product::find($id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Product::find($id)->delete());
    }
}
