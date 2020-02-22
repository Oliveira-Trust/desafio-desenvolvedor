<?php

namespace App\Http\Controllers;

use App\Filters\CustomerFilters;
use App\Http\Requests\StoreCustomer;
use App\Http\Resources\Customer as CustomerResource;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CustomerFilters $customerFilters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CustomerFilters $customerFilters)
    {
        $users = User::select('id', 'cpf', 'name', 'email')
            ->filter($customerFilters)
            ->orderBy('name')
            ->paginate(15);
        return CustomerResource::collection($users);
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
     * @return CustomerResource
     */
    public function show(User $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
