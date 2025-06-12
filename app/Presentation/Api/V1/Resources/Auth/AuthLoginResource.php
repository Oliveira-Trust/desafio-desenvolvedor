<?php

namespace Presentation\Api\V1\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthLoginResource extends JsonResource {
    public function toArray(Request $request) {
        return [
            'accessToken' => $this->plainTextToken,
        ];
    }
}
