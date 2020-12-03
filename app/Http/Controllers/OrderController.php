<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->withTrashed()->latest()->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->pluck('name', 'id')->prepend(__('Select').'...','');
        $products = Product::where('stock', '>=', 1)->pluck('name', 'id')->prepend(__('Select').'...','');
        return view('orders.create', compact('customers', 'products'));
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
            'customer_id' => 'required',
            'code' => 'required|max:100|unique:orders,code'
        ]);

        try {
            DB::beginTransaction();
            $newOrder = $this->order->create(array_merge($request->only('customer_id', 'code', 'status', 'order_total_price'),['user_id' => auth()->user()->id]));

            foreach($request->product_id as $key => $product){
                $newOrder->products()->attach([
                    $request->product_id[$key] => [
                        'amount' => $request->amount[$key],
                        'total_price' => str_replace(',', '.', str_replace('.', '', $request->total_price[$key])),
                    ]
                ]);

            $updateProduct = Product::find($request->product_id[$key]);
            $updateProduct->stock = $updateProduct->stock - $request->amount[$key];
            $updateProduct->save();
            }

            DB::commit();
            return redirect()->route('order.index')
                ->with('status', __('Order added successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to add Order'))
                ->with('status-type', 'warning');
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
        $order = $this->order->with('products')->find($id);
        $customers = Customer::orderBy('name')->pluck('name', 'id')->prepend(__('Select').'...','');
        $products = Product::where('stock', '>=', 1)->pluck('name', 'id')->prepend(__('Select').'...','');

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->order->with('products')->find($id);
        $customers = Customer::orderBy('name')->pluck('name', 'id')->prepend(__('Select').'...','');
        $products = Product::where('stock', '>=', 1)
            ->orWhere(function ($query){
                $query->whereExists(function ($subQuery){
                    $subQuery->select(DB::raw(1))
                        ->from('order_product')
                        ->whereRaw('products.id = order_product.product_id');
                });
            })->pluck('name', 'id')->prepend(__('Select').'...','');
        return view('orders.edit', compact('order', 'customers', 'products'));
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
        $request->validate([
            'customer_id' => ['required'],
            'code' => ['required', 'max:100', Rule::unique('orders')->ignore($id)]
        ]);

        try {
            DB::beginTransaction();
            $updateOrder = $this->order->find($id);
            $updateOrder->update(array_merge($request->only('customer_id', 'code', 'status', 'order_total_price'),['user_id' => auth()->user()->id]));
            foreach($request->product_id as $key => $product){
                $orderProductAmount = $updateOrder->products()->find($product)->pivot->amount ?? null;

                Product::updateStockProduct($product, (int) $request->amount[$key], $orderProductAmount);

                $updateOrder->products()->detach($product);
                $updateOrder->products()->attach([
                    $product => [
                        'amount' => $request->amount[$key],
                        'total_price' => str_replace(',', '.', str_replace('.', '', $request->total_price[$key])),
                    ]
                ]);
            }

            DB::commit();
            return redirect()->route('order.index')
                ->with('status', __('Order added successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return back()->withInput()
                ->with('status', __('Failed to add Order'))
                ->with('status-type', 'warning');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->order->destroy($id);
            DB::commit();
            return redirect()->route('order.index')
                ->with('status', __('Order successfully deleted'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete order'))
                ->with('status-type', 'warning');
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->order->withTrashed()->find($id)->restore();
            DB::commit();
            return redirect()->route('order.index')
                ->with('status', __('Restored order'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to restore order'))
                ->with('status-type', 'warning');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $deleteOrder = $this->order->withTrashed()->find($id);
            foreach($deleteOrder->products as $product){
                Product::updateStockProduct($product->pivot->product_id, $product->pivot->amount);
            }
            $deleteOrder->forceDelete();
            DB::commit();
            if($request->ajax()){
                return response()->json([
                    'status' => __('Permanently deleted order'),
                    'status-type' => 'success'
                ]);
            }
                return redirect()->route('order.index')
                    ->with('status', __('Permanently deleted order'))
                    ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete order permanently'))
                ->with('status-type', 'warning');
        }
    }
}
