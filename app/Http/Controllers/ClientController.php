<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new \Okipa\LaravelTable\Table)->model(Client::class)->routes([
            'index'   => ['name' => 'client.index'],
            'edit'    => ['name' => 'client.edit'],
            'destroy' => ['name' => 'client.destroy'],
            'create'  => ['name' => 'client.create'],
            'show'  => ['name' => 'client.show'],
        ])->destroyConfirmationHtmlAttributes(function (Client $client) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $client->name . ' ?',
            ];
        });
        $table->column('name')->title('Name')->sortable(true)->searchable();
        $table->column('phone')->title('Phone Number')->sortable()->searchable();
        $table->column('address')->title('Complete Address')->sortable()->searchable();
        $table->column('user_id')->title('Usuário responsável')->sortable()->searchable()
        ->value(function($client){
            return $client->user->name;
        })
        ->link(function($client) {
            // return route('users.show', $client->user->id);
        });

        return view('list')
        ->with('table', $table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.form')->with('model',new Client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client($request->except('_token'));
        $client->save();
        return redirect()->route('client.index')
        ->with('success', "Cliente $client->name criado com Sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.form')->with('model', $client)->with('show',true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.form')->with('model', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->except('_token'));
        return redirect()->route('client.index')
        ->with('success', "Cliente $client->name Atualizado com Sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('client')->with('success','O Cliente foi apagado com sucesso!');
    }
}
