<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->clientService->all();
        return view('client.index')->with(["clients" => $clients]);
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $this->clientService->save([
            "name" => $request->get('name'),
            "email" => $request->get('email')
        ]);
        return redirect('clients');
    }

    public function show($id)
    {
        $client = $this->clientService->find($id);
        return view('client.show')->with(["client" => $client]);
    }

    public function edit($id)
    {
        $client = $this->clientService->find($id);
        return view('client.edit')->with(["client" => $client]);
    }

    public function update(Request $request, $id)
    {
        $this->clientService->update($request->all(), $id);
        return redirect('clients');
    }

    public function destroy($id)
    {
        $this->clientService->destroy($id);
        return redirect('clients');
    }
}
