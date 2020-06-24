<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Response\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Requests\StatusRequest;
use App\Repositories\StatusRepository;

class StatusController extends Controller
{
    /**
     * Access to User Repository
     */
    protected $statusRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->middleware('auth:api');
        $this->statusRepository = $statusRepository;
    }

    /**
     * Show the Status table.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return JsonResponse::success(
            true, 
            'status.index', 
            $this->statusRepository->all()->toArray()
        );
    }

    /**
     * Show the Status item.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return JsonResponse::success(
            true, 
            'status.show', 
            $this->statusRepository->getById($id)->toArray()
        );
    }
    
    /**
     * Create a Status item.
     *
     * @return JsonResponse
     */
    public function store(StatusRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->statusRepository->create($validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Update a Status item.
     *
     * @return JsonResponse
     */
    public function update($id, StatusRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->statusRepository->update($id, $validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Delete a Status item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            return $this->statusRepository->delete($id);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
}
