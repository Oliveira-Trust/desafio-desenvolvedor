<?php

namespace App\Http\Controllers;

use App\Filters\PurchaseFilters;
use App\Product;
use App\PurchaseOrder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param PurchaseFilters $purchaseFilters
     * @return Factory|\Illuminate\View\View
     */
    public function index(Request $request, PurchaseFilters $purchaseFilters)
    {
        $results = PurchaseOrder::with('customer:id,name')
            ->filter($purchaseFilters)
            ->orderBy($request->input('order', 'id'), 'desc')
            ->paginate(10);
        return view('purchase.index')->with(compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();
        return view('purchase.form')->with(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->validateQtd($request->input('qtd'))) {
            $purchase = new PurchaseOrder();
            $purchase->user_id = auth()->user()->id;
            $purchase->amount = 0;
            $purchase->save();
            // Esses dois metodos chamados abaixo podem ser melhorados e movidos para outro lugar
            $this->storeItems($request->all(), $purchase->id);
            $this->setAmount($purchase);
            return redirect()->route('purchase.show', $purchase->id)
                ->with([
                    'aviso' => 'Pedido realizado com sucesso.',
                    'type' => 'success'
                ]);
        }
        return redirect()->route('purchase.create')
            ->with([
                'aviso' => 'Pedido não realizado. Informe ao menos 1 item.',
                'type' => 'danger'
            ]);
    }

    /**
     * Filter and validate quantity of products
     * @param $qtd
     * @return int
     */
    private function validateQtd($qtd)
    {
        $collection = collect($qtd);
        $filtered = $collection->filter(function ($value, $key) {
            return $value > 0;
        });
        return $filtered->count();
    }

    /**
     * Store purchase order items
     * @param $input
     * @param $purchase_id
     *
     */
    private function storeItems($input, $purchase_id)
    {
        foreach ($input['qtd'] as $key => $value) {
            if (!is_null($value)) {
                $unitary_price = Product::select('price')->find($key);
                DB::table('product_purchase')->insert([
                    'purchase_order_id' => $purchase_id,
                    'product_id' => $key,
                    'unitary_price' => $unitary_price->price,
                    'qtd' => $value,
                    'total_price' => $unitary_price->price * $value,
                ]);
            }
        }
    }

    /**
     * @param $purchase
     * Calculate and set amount to purchase, from sum of items.
     */
    private function setAmount($purchase)
    {
        $amount = DB::table('product_purchase')
            ->where('purchase_order_id', $purchase->id)
            ->sum('total_price');
        $purchase->amount = $amount;
        $purchase->save();
    }

    /**
     * Display the specified resource.
     *
     * @param PurchaseOrder $purchase
     * @return void
     */
    public function show(PurchaseOrder $purchase)
    {
        $purchase = PurchaseOrder::with(['customer', 'products'])->get()->find($purchase->id);
        return view('purchase.show')->with(compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PurchaseOrder $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchase)
    {

        $products = DB::table('products')
            ->select('products.*')
            ->selectRaw('(select qtd from tbl_product_purchase pp '
                . 'where pp.product_id=tbl_products.id and pp.purchase_order_id=?) as qtd', [$purchase->id])
            ->get();

        $purchased = PurchaseOrder::with(['customer'])
            ->where('id', $purchase->id);
        if (!is_null($purchased)) {
            return view('purchase.form')->with(compact('products', 'purchase'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PurchaseOrder $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PurchaseOrder $purchase)
    {
        $input = $request->only('qtd');

        if ($this->validateQtd($input['qtd'])) {
            DB::table('product_purchase')
                ->where('purchase_order_id', '=', $purchase->id)->delete();
            $this->storeItems($input, $purchase->id);
            $this->setAmount($purchase);
            return redirect()->route('purchase.show', $purchase->id)
                ->with([
                    'aviso' => 'Pedido alterado com sucesso.',
                    'type' => 'success'
                ]);
        }
        return redirect()->route('purchase.edit', $purchase->id)
            ->with([
                'aviso' => 'Pedido não alterado. Informe ao menos 1 item.',
                'type' => 'danger'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PurchaseOrder $purchase
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PurchaseOrder $purchase)
    {
        if ($purchase->delete()) {
            return redirect()->route('purchase.index')->with(
                [
                    'aviso' => 'Pedido deletado.',
                    'type' => 'info'
                ]
            );
        }
    }

    public function status(Request $request, PurchaseOrder $purchase)
    {
        $purchase->status = $request->input('status');
        if ($purchase->save()) {
            return redirect()->route('purchase.index')->with(
                [
                    'aviso' => 'Mudança de status efetuada com sucesso.',
                    'type' => 'info'
                ]
            );
        }
    }
}
