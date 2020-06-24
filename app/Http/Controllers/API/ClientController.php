<?php

namespace App\Http\Controllers\API;

use App\Response\JsonResponse;
use Illuminate\Routing\Controller;
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
        $this->middleware('auth:api');
        $this->clientRepository = $clientRepository;
    }

    /**
     * Show the Client list
     *
     * @return JsonResponse
     */
    public function index()
    {
        return JsonResponse::success(
            true, 
            'Client.index', 
            $this->clientRepository->all()->toArray()
        );
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
            'Client.show', 
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
        try {
            return $this->clientRepository->create($validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Update a Client item.
     *
     * @return JsonResponse
     */
    public function update($id, ClientRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->clientRepository->update($id, $validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Delete a Client item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            return $this->clientRepository->delete($id);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
}
