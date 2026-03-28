<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileUploadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->_id,
            'original_name' => $this->original_name,
            'status' => $this->status,
            'reference_date' => $this->reference_date,
            'total_records' => $this->total_records,
            'processed_records' => $this->processed_records,
            'error_message' => $this->when(
                $this->status === 'failed',
                $this->error_message
            ),
            'uploaded_by' => $this->uploaded_by,
            'uploaded_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
