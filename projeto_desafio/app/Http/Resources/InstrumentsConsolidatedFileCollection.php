<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InstrumentsConsolidatedFileCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'totalItens' => $this->total(),
            'perPage' => $this->perPage(),
            'current' => $this->currentPage(),
            'nextPage' => $this->hasMorePages() ? $this->currentPage() + 1 : null,
            'previusPage' => $this->currentPage() > 1 ? $this->currentPage() - 1 : null,
            'data' => $this->collection,
        ];
    }
}
