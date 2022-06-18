<?php

namespace Oliveiratrust\Quotation;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Oliveiratrust\Base\Traits\ResponseTrait;
use Oliveiratrust\Models\Quotation\Quotation;

class QuotationController extends Controller {

    use ResponseTrait;

    public function __construct(
        private QuotationService $service
    ){}

    public function show(int $id)
    {
        $data = Quotation::find($id);

        return new QuotationResource($data);
    }

    public function store(QuotationRequest $request)
    {
        $data = $data === 0
        ? $this->service->quotation($request->validated())
        : $this->service->quotation($request->validated());

        return  QuotationResource::collection($data);
    }
}
