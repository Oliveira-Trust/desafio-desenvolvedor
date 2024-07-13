<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property float $rate
 * @property string $slug
 * @property string $name
 */
class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
