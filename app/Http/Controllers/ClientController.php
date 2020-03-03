<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client as RequestsClient;
use App\Models\Client;

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
            'index'   => ['name' => 'clients.index'],
            'edit'    => ['name' => 'clients.edit'],
            'destroy' => ['name' => 'clients.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (Client $client) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $client->name . ' ?',
            ];
        })->query(function($query){
            $query->byAuthorizedUser();
        });
        $table->column('name')->title('Name')->sortable(true)->searchable();
        
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
        return view('form')
        ->with('model', new Client());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsClient $request)
    {
        Client::create($request->all('name'));
        return redirect('clients')
        ->with('success', 'create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('form')
        ->with('model', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsClient $request, Client $client)
    {
        $client->update($request->all('name'));
        return redirect('clients')
        ->with('success', 'save success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('clients')->with('success','Client has been  deleted');
    }
}
