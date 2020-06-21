<?php

namespace App\Http\Controllers;

use App\Response\JsonResponse;
use App\DataTables\StatusDataTable;
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
        $this->middleware('auth');
        $this->statusRepository = $statusRepository;
    }

    /**
     * Show the Status table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(StatusDataTable $dataTable)
    {
        $refs = $this->statusRepository->getRefTables();
        return $dataTable->render('painel.status.index', [
            'ref_tables' => $refs
        ]);
    }

    /**
     * Show the Status table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allData()
    {
        return $this->statusRepository->all();
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
            '', 
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
        return $this->statusRepository->create($validFields);
    }
    
    /**
     * Update a Status item.
     *
     * @return JsonResponse
     */
    public function update($id, StatusRequest $request)
    {
        $validFields = $request->validated();
        return $this->statusRepository->update($id, $validFields);
    }
    
    /**
     * Delete a Status item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->statusRepository->delete($id);
    }
}
