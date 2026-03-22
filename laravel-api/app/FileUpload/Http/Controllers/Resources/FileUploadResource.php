<?php

declare(strict_types=1);

namespace App\FileUpload\Http\Controllers\Resources;

use App\FileUpload\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileUploadResource extends JsonResource
{
    /** @var FileUpload */
    public function toArray(Request $request): array
    {
        return [
            'original_name' => $this->original_name,
            'stored_name' => $this->stored_name,
            'status' => $this->status,
            'reference_date' => $this->reference_date?->toDateString(),
        ];
    }
}
