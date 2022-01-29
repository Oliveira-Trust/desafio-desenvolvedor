<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment_methods.index')
            ->with('itens', PaymentMethod::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'fee' => 'required',
        ]);

        PaymentMethod::create([
            'title' => $request->input('title'),
            'fee' => $request->input('fee'),
        ]);

        return redirect('/payment_methods')
            ->with('message', 'Item cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('payment_methods.show')
            ->with('item', PaymentMethod::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('payment_methods.edit')
            ->with('item', PaymentMethod::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'fee' => 'required',
        ]);

        PaymentMethod::where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'fee' => $request->input('fee'),
            ]);

        return redirect('/payment_methods')
            ->with('message', 'Item atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::where('id', $id);
        $paymentMethod->delete();

        return redirect('/payment_methods')
            ->with('message', 'Item excluido com sucesso!');
    }

}
