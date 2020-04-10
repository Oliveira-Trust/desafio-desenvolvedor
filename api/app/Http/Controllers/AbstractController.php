<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AbstractController extends Controller
{
    abstract protected function getModel();
    
    abstract protected function modelValidation(Request $request);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
        $this->modelValidation($request);

        $data = $request->all();
        $item = ($this->getModel())::create($data);
        return response()->json(['success' => true, 'data' => $item]);
     }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($itemId)
    {
        $item = ($this->getModel())::find($itemId);
        if($item) {
            return response()->json(['success' => true, 'data' => $item]);
        } else {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Não encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemId)
    {
        $item = ($this->getModel())::find($itemId);
        if($item) {
            $item->update($request->all());
            return response()->json(['success' => true, 'data' => $item]);
        } else {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Não encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemId)
    {
        $item = ($this->getModel())::find($itemId);
        if($item) {
            $item->delete();
            return response()->json(['success' => true, 'data' => [], 'message' => 'Excluído com sucesso']);
        } else {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Não encontrado'], 404);
        }
    }
}