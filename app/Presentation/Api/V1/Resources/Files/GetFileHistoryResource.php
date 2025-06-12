<?php

namespace Presentation\Api\V1\Resources\Files;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetFileHistoryResource extends JsonResource {
    public function toArray(Request $request)
    {
        return [
            '_id' => $this->_id,
            'filename' => $this->filename,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
