<?php

namespace App\Http\Controllers;

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
    public function store()
    {
        Client::query()->create(request()->all());
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
    public function update(Client $client)
    {
        Client::query()->where('id', $client->id)
            ->update(request()->only('name', 'email'));
        return redirect()->route('index_client');
    }
    public function delete(Client $client)
    {
        Client::query()->where('id', $client->id)->delete();
    }
}
