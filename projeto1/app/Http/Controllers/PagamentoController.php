<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use Stripe\Stripe;
use Session;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "controller pagamento";
        //return view('checkout');
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
        //dd($request->all());

        try{
           \Stripe\Stripe::setApiKey('sk_test_51HUvI5LQLXuCAcHbgMSXvvuZpTgkigYRHuvVstDTcsAWCfTHxJ7MUkShzl6waJcVJFODSM7ixGMqvgmybwbJtppz00n8wjv5Aw');

            \Stripe\PaymentIntent::create([
                'amount' => "10000000",
                'currency' => 'BRL',
                'source' => $request->stripToken,
                'description'=>"order"
            ]);

            $pagamento = new Pagamento();
            $pagamento->preco = 100000;
            $pagamento->moeda = "BRL";
            $pagamento->descricao = "ordem";
            $pagamento->fonte = "request->stripToken";


        if($pagamento->save())
        {
            Session::forget('carrinho');
            return redirect('produtos');

        }

        }catch(Exception $e)
        {
            echo "erro";
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
