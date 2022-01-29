<?php

namespace App\Http\Controllers;

use App\Models\FeesSetup;
use Illuminate\Http\Request;

class FeesSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fees_setup.index')
            ->with('item', FeesSetup::first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\FeesSetup  $feesSetup
     * @return \Illuminate\Http\Response
     */
    public function show(FeesSetup $feesSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesSetup  $feesSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesSetup $feesSetup)
    {
        return view('fees_setup.edit')
            ->with('item', FeesSetup::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeesSetup  $feesSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeesSetup $feesSetup)
    {
        $request->validate([
            'fee_1' => 'required',
            'fee_2' => 'required',
        ]);

        FeesSetup::where('id', $feesSetup->id)
            ->update([
                'fee_1' => $request->input('fee_1'),
                'fee_2' => $request->input('fee_2'),
            ]);

        return redirect('/payment_fees')
            ->with('message', 'Item atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesSetup  $feesSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesSetup $feesSetup)
    {
        //
    }
}
