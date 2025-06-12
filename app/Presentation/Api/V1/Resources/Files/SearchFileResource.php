<?php

namespace Presentation\Api\V1\Resources\Files;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchFileResource extends JsonResource {
    public function toArray(Request $request)
    {
        return (array) $this->data;
    }
}
