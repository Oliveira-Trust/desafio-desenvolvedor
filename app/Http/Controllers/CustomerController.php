<?php

namespace App\Http\Controllers;

use App\Filters\CustomerFilters;
use App\Http\Requests\StoreCustomer;
use App\Http\Resources\Customer as CustomerResource;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CustomerFilters $customerFilters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|Factory|\Illuminate\View\View
     */
    public function index(Request $request, CustomerFilters $customerFilters)
    {
        $results = User::select('id', 'cpf', 'name', 'email')
            ->filter($customerFilters)
            ->orderBy($request->input('order','name'))
            ->paginate(15);
        if ($request->wantsJson()) {
            return CustomerResource::collection($results);
        }
        return view('customer.index')->with(compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('customer.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CustomerResource
     */
    public function store(StoreCustomer $request)
    {
        $customer = new User();
        $customer->name = $request->input('name');
        $customer->cpf = $request->input('cpf');
        $customer->email = $request->input('email');
        $customer->password = $request->input('password');
        $customer->admin = $request->input('admin');
        $customer->save();
        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param User $customer
     * @return CustomerResource|Factory|\Illuminate\View\View
     */
    public function show(Request $request, User $customer)
    {
        if ($request->wantsJson()) {
            return new CustomerResource($customer);
        }
        return view('customer.show')->with(compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('customer.form')->with(compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $customer
     * @return void
     */
    public function update(Request $request, User $customer)
    {
        $input = $request->only('name', 'cpf', 'email', 'password', 'admin');
        $customer->fill($input);
        $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $customer
     * @return void
     * @throws \Exception
     */
    public function destroy(User $customer)
    {
        $customer->delete();
    }
}
