<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientsController extends Controller {

    /**
     * List of all clients.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $clients = Client::query()
            ->orderBy('name')
            ->get();

        $message = $request->session()->get('message');

        return view('clients.list', compact('clients', 'message'));
    }

    /**
     * Show create clients form.
     *
     * @return Application|Factory|View
     */
    public function create() {
        return view('clients.create');
    }

    /**
     * Store client data on database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $client = Client::create($request->all());

        $this->setFlashMessage($request, 'Novo cliente adicionado com sucesso!');

        return redirect()->route('listClients');
    }

    /**
     * Show edit client form.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function edit(int $id) {
        $client = Client::find($id);

        if (!$client) return redirect()->route('listClients');

        return view('clients.edit', compact('client'));
    }

    /**
     * Update a given client.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request) {
        $client = Client::find($id);

        if ($client) {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->birthday = $request->birthday;

            $client->save();

            $this->setFlashMessage($request, 'Cliente editado com sucesso!');
        }

        return redirect()->route('listClients');
    }

    public function destroy(int $id, Request $request) {
        $client = Client::find($id);

        if ($client) {
            $client->delete();

            $this->setFlashMessage($request, 'Cliente excluído com sucesso!');
        }

        return redirect()->route('listClients');
    }

    private function setFlashMessage(Request $request, $message) {
        $request->session()->flash('message', $message);
    }
}
