<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\Customer\CustomerDTO as Customer;
use App\Repository\Customer\CustomerIRepository;

class CustomerController extends Controller
{
    private $customerIRepository;

    public function __construct(
        CustomerIRepository $customerIRepository
    )
    {
        $this->customerIRepository = $customerIRepository;
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        return $this->customerIRepository->readAll();
    }

    public function show(Request $request, $id) {
        $customer = $this->customerIRepository->read($id);

        if ($customer === []) {
            return response()->json( [
                "message" => "Not found."
            ], 404);
        }

        return $customer;
    }

    public function store(Request $request) {

        //validate incoming request
        $this->validate($request, Customer::rules());

        try
        {
            $customer = new Customer($request->all());
            $this->customerIRepository->create($customer);

            return response()->json( [
                'entity' => 'customers',
                'action' => 'store',
                'result' => 'success'
            ], 201);

        }
        catch (\Exception $e)
        {
            return response()->json( [
                'entity' => 'customers',
                'action' => 'store',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }

    public function update(Request $request, $id) {
        $customer = $this->customerIRepository->read($id);

        if ($customer === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        $this->validate($request, Customer::rulesUpdate($id));

        try {
            $customerDTO = new Customer($request->all());
            $customerUpdated = $this->customerIRepository->update($id, $customerDTO);

            if ($customerUpdated == $customer) {
                return response()->json( [
                    "message" => "Nothing to change."
                ], 400);
            }

            return response()->json( $customerUpdated, 200);

        } catch (\Exception $e) {
            return response()->json( [
                'entity' => 'customers',
                'action' => 'update',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }


    public function delete(Request $request, $id) {
        $customer = $this->customerIRepository->read($id);

        if ($customer === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        if ($this->customerIRepository->delete($id)) {
            return response()->json( ["message" => "success"], 200);
        }
        return response()->json( ["message" => "Error"], 400);
    }

    public function deleteArray(Request $request) {

        if (!isset($request->ids) || count($request->ids) == 0) {
            return response()->json( ["message" => "Empty ids."], 422);
        }

        $customers = $this->customerIRepository->readArray($request->ids);

        if ($customers === []) {
            return response()->json( ["message" => "Not found."], 404);
        }
        $errorDelete = false;
        foreach ($customers as $customer) {
            if (!$this->customerIRepository->delete($customer['id'])) {
                $errorDelete = true;
            }
        }

        if ($errorDelete) return response()->json( ["message" => "Error"], 400);

        return response()->json( ["message" => "success"], 200);
    }
}
