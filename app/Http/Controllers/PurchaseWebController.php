<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseFormRequest;
use App\Model\Client;
use App\Model\Product;
use App\Model\Purchase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseWebController extends Controller
{
    private Collection $clients;

    private Collection $products;

    public function __construct()
    {
        $this->clients = Client::all();
        $this->products = Product::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchases', ['purchases' => Purchase::with('client', 'product')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.purchase', [
            'clients' => $this->clients,
            'products' => $this->products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseFormRequest $request)
    {
        try {
            Purchase::create([
                'client_id' => $request->client_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'status' => 'PENDING',
            ]);

            return back()->with('message', 'Registro cadastrado com sucesso.');
        } catch (\PDOException $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível cadastrar o registro.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('show.purchase', ['purchase' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('edit.purchase', [
            'purchase' => $purchase,
            'clients' => $this->clients,
            'products' => $this->products,
            'status' => ['PENDING' => 'Pendente', 'PAY' => 'Pago', 'CANCELED' => 'Cancelado'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        try {
            $purchase->update($request->all());

            return back()->with('message', 'Registro atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        try {
            $purchase->delete();

            return redirect()->route('purchases.index')
                ->with('message', 'Registro deletado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }
}
