<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Client::create($request->all());

            return back()->with('message', 'Registro cadastrado com sucesso.');
        } catch (\PDOException $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível cadastrar o registro.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('show.client', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('edit.client', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        try {
            $client->update($request->all());

            return back()->with('message', 'Registro atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();

            return redirect()->route('clients.index')
                ->with('message', 'Registro deletado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }
}
