<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    private $custumer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->withTrashed()->paginate(20);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'name' => 'required|max:100|unique:customers,name',
            'email' => 'required|max:100|email|unique:customers,email',
            'phone' => 'required|max:15|min:14|unique:customers,phone',
            'address' => 'required|max:200'
        ]);

        try {
            DB::beginTransaction();
            $this->customer->create($request->only('name', 'email', 'phone', 'address'));
            DB::commit();
            return redirect()->route('customer.index')
                ->with('status', __('Customer added successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to add Customer'))
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
        $customer = $this->customer->find($id);
        $orders = $customer->orders()->get();

        return view('customers.show', compact('customer', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->customer->find($id);

        return view('customers.edit', compact('customer'));
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
            'name' => ['required', 'max:100', Rule::unique('customers')->ignore($id)],
            'email' => ['required', 'max:100 ', 'email', Rule::unique('customers')->ignore($id)],
            'phone' => ['required', 'max:15 ', 'min:14', Rule::unique('customers')->ignore($id)],
            'address' => 'required|max:200'
        ]);

        try {
            DB::beginTransaction();
            $this->customer->find($id)->update($request->only('name', 'email', 'phone', 'address'));
            DB::commit();
            return redirect()->route('customer.edit', $id)
                ->with('status', __('Customer changed successfully'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to change Customer'))
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
            $this->customer->destroy($id);
            DB::commit();
            return redirect()->route('customer.index')
                ->with('status', __('Customer successfully deleted'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete customer'))
                ->with('status-type', 'warning');
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->customer->withTrashed()->find($id)->restore();
            DB::commit();
            return redirect()->route('customer.index')
                ->with('status', __('Restored customer'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to restore customer'))
                ->with('status-type', 'warning');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->customer->withTrashed()->find($id)->forceDelete();
            DB::commit();
            if($request->ajax()){
                return response()->json([
                    'status' => __('Permanently deleted customer'),
                    'status-type' => 'success'
                ]);
            }
            return redirect()->route('customer.index')
                ->with('status', __('Permanently deleted customer'))
                ->with('status-type', 'success');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()
                ->with('status', __('Failed to delete customer permanently'))
                ->with('status-type', 'warning');
        }
    }
}
