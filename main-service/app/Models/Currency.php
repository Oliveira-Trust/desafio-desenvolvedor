<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public const DEFAULT_CURRENCY = 'BRL';

    protected $fillable = ['name', 'code', 'status'];

    protected $casts = [
        'status' => StatusType::class
    ];

    private $name;
    private $code;
    private $status;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getStatus(): bool
    {
        if ($this->status instanceof StatusType) {
            return $this->status->value;
        }
        return $this->status;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setStatus(StatusType $status): void
    {
        $this->status = $status;
    }

    public static function createFromEloquent(Currency $values): Currency
    {
        $cur = new self;
        $cur->setName($values['name']);
        $cur->setCode($values['code']);
        $cur->setStatus($values['status']);

        return $cur;
    }

    // Mutator
    public function setCodeAttribute($value) : void
    {
        $this->attributes['code'] = strtoupper($value);
    }
}
