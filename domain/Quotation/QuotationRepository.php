<?php

namespace Oliveiratrust\Quotation;

use Illuminate\Database\Eloquent\Collection;
use Oliveiratrust\Models\Quotation\Quotation;

class QuotationRepository {

    public function __construct(
        private Quotation $model
    ){}

    public function list(): Collection
    {
        $user_id = auth()->user()->id;

        return $this->model->with('paymentType', 'currency')
                           ->where('user_id', $user_id)
                           ->latest()
                           ->get();
    }
}
