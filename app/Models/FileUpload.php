<?php declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class FileUpload extends Model
{
    protected $connection = 'mongodb';
    protected string $collection = 'file_uploads';

    public const string STATUS_PENDING = 'pending';
    public const string STATUS_PROCESSING = 'processing';
    public const string STATUS_COMPLETED = 'completed';
    public const string STATUS_FAILED = 'failed';

    protected $fillable = [
        'original_name',
        'stored_name',
        'hash',
        'status',
        'reference_date',
        'total_records',
        'processed_records',
        'error_message',
        'uploaded_by',
    ];

    protected $casts = [
        'total_records' => 'integer',
        'processed_records' => 'integer',
    ];

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeByName($query, string $name)
    {
        return $query->where('original_name', 'like', "%{$name}%");
    }

    public function scopeByReferenceDate($query, string $date)
    {
        return $query->where('reference_date', $date);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    public function markAsProcessing(): void
    {
        $this->update(['status' => self::STATUS_PROCESSING]);
    }

    public function markAsCompleted(int $total): void
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'total_records' => $total,
            'processed_records' => $total,
        ]);
    }

    public function markAsFailed(string $message): void
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'error_message' => $message,
        ]);
    }
}
