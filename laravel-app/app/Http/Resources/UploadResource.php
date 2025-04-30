<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'original_name' => $this->original_name,
            'status' => $this->status,
            'reference_date' => $this->reference_date ? $this->reference_date->format('Y-m-d') : null,
            'total_records' => $this->total_records,
            'processed_at' => $this->processed_at ? $this->processed_at->format('Y-m-d H:i:s') : null,
            'error_message' => $this->error_message,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
} 