<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_currency',
        'to_currency',
        'amount',
        'payment_method',
        'payment_fee',
        'conversion_fee',
        'new_amount',
        'quotation',
        'amount_converted',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y - H:i',
        'updated_at' => 'datetime:d/m/Y - H:i',
        'status' => StatusType::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
