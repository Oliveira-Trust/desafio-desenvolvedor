<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;


class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }
    public function create()
    {
        return view('client.create');
    }
    public function store(ClientRequest $request)
    {
        Client::query()->create($request->validated());
        return redirect()->route('index_client');
    }
    public function show(Client $client)
    {
        return view('client.show', compact('client'));
    }
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }
    public function update(Client $client, ClientRequest $request)
    {
        Client::query()->where('id', $client->id)
            ->update($request->validated());
        return redirect()->route('index_client');
    }
    public function destroy(Client $client)
    {
        Client::query()->where('id', $client->id)->delete();
        return redirect()->route('index_client');
    }
}
