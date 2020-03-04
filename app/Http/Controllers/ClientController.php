<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        
        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->datebirth = $request->datebirth;
        $client->cpf = $request->cpf;
        $client->telephone = $request->telephone;
        $client->save();
        
        return redirect()->route('clients.index');
    }

    /**
     * 
     * @param Client $client
     * @return type
     */
    public function show(Client $client)
    {
        $purchaseRequests = \App\PurchaseRequest::where('id_client', $client->id)->count();
        
        return view('clients.show', ['client' => $client, 'purchaseRequests' => $purchaseRequests]);
    }

    /**
     * 
     * @param Client $client
     * @return type
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * 
     * @param Request $request
     * @param Client $client
     * @return type
     */
    public function update(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->datebirth = $request->datebirth;
        $client->cpf = $request->cpf;
        $client->telephone = $request->telephone;
        $client->save();
        
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Client $client
     * @return 
     */
    public function destroy(Client $client)
    {
        Client::destroy($client->id);
        
        return redirect()->route('clients.index');
    }
    
    public function destroySelected(Request $request)
    {
        Client::destroy($request->ids);
        return;
    }
}
