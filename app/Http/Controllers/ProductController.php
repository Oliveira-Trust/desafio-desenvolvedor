<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->withTrashed()->paginate(20);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'code' => 'required|max:100|unique:products,code',
            'name' => 'required|max:100|unique:products,name',
            'price' => 'required|max:15|min:3',
            'stock' => 'required|numeric',
            'description' => 'required|min:10'
        ]);

        try {
            DB::beginTransaction();
            $this->product->create($request->only('code', 'name', 'price', 'stock', 'description'));
            DB::commit();
            return redirect()->route('product.index')
                ->with('status', __('Product added successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return back()->withInput()
                ->with('status', __('Failed to add Product'))
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
        $product = $this->product->find($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        return view('products.edit', compact('product'));
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
            'code' => ['required', 'max:100', Rule::unique('products')->ignore($id)],
            'name' => ['required', 'max:100', Rule::unique('products')->ignore($id)],
            'price' => ['required', 'max:15', 'min:3'],
            'stock' => ['required', 'numeric'],
            'description' => ['required', 'min:10']
        ]);

        try {
            DB::beginTransaction();
            $this->product->find($id)->update($request->only('code', 'name', 'price', 'stock', 'description'));
            DB::commit();
            return redirect()->route('product.index')
                ->with('status', __('Product changed successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return back()->withInput()
                ->with('status', __('Failed to change Product'))
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
            $this->product->destroy($id);
            DB::commit();
            return redirect()->route('product.index')
                ->with('status', __('Product successfully deleted'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete product'))
                ->with('status-type', 'warning');
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->product->withTrashed()->find($id)->restore();
            DB::commit();
            return redirect()->route('product.index')
                ->with('status', __('Restored product'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to restore product'))
                ->with('status-type', 'warning');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->product->withTrashed()->find($id)->forceDelete();
            DB::commit();
            return redirect()->route('product.index')
                ->with('status', __('Permanently deleted product'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete product permanently'))
                ->with('status-type', 'warning');
        }
    }
}
