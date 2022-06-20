<?php

namespace Oliveiratrust\Fee;

use App\Http\Controllers\Controller;
use Gate;

class FeeController extends Controller {

    public function __construct(
        private FeeRepository $repository,
        private FeeService    $service
    )
    {
    }

    public function index()
    {
        Gate::authorize('can-view-fees');

        $data = $this->repository->list();

        return FeeResource::collection($data);
    }

    public function store(FeeRequest $request)
    {
        $this->service->create($request->validated());

        return [];
    }

    public function update($id, FeeRequest $request)
    {
        $this->service->update($id, $request->validated());

        return [];
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return [];
    }
}
