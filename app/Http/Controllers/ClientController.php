<?php

namespace App\Http\Controllers;

use App\Response\JsonResponse;
use App\DataTables\ClientDataTable;
use App\Http\Requests\ClientRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    /**
     * Access to User Repository
     */
    protected $clientRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->middleware('auth');
        $this->clientRepository = $clientRepository;
    }

    /**
     * Show the Client table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ClientDataTable $dataTable)
    {
        $statuses = $this->clientRepository->getClientStatuses();
        return $dataTable->render('painel.client.index', [
            'statuses' => $statuses
        ]);
    }

    /**
     * Show the Client table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allData()
    {
        return $this->clientRepository->all();
    }

    /**
     * Show the Client item.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return JsonResponse::success(
            true, 
            '', 
            $this->clientRepository->getById($id)->toArray()
        );
    }
    
    /**
     * Create a Client item.
     *
     * @return JsonResponse
     */
    public function store(ClientRequest $request)
    {
        $validFields = $request->validated();
        return $this->clientRepository->create($validFields);
    }
    
    /**
     * Update a Client item.
     *
     * @return JsonResponse
     */
    public function update($id, ClientRequest $request)
    {
        $validFields = $request->validated();
        return $this->clientRepository->update($id, $validFields);
    }
    
    /**
     * Delete a Client item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->clientRepository->delete($id);
    }
}
