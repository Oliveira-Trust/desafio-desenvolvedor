<?php

namespace Oliveiratrust\Quotation;

use App\Http\Controllers\Controller;

class QuotationController extends Controller {

    public function __construct(
        private QuotationService    $service,
        private QuotationRepository $repository
    ){}

    public function index()
    {
        $data = $this->repository->list();

        return QuotationResource::collection($data);
    }

    public function store(QuotationRequest $request)
    {
        $data = $this->service->quotation($request->validated());

        return new QuotationResource($data);
    }

    public function sendEmail($id)
    {
        $this->service->sendEmail($id);

        return [];
    }
}
