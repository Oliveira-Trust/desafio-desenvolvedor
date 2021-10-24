<?php

namespace App\Http\Controllers\Api\v1\Dominio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Dominio\DominioItemService;

class DominioItemController extends Controller
{
    protected DominioItemService $dominioItemService;

    public function __construct(
        DominioItemService $dominioItemService
    ){
        $this->dominioItemService = $dominioItemService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return [
            'success' => true, 
            'data' => $this->dominioItemService->getDominioItensById($id)
        ];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
