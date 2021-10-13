<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['method', 'fee', 'status'];

    protected $casts = [
        'status' => StatusType::class
    ];

    private $method;
    private $fee;
    private $status;

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getFee() : float
    {
        return $this->fee;
    }

    public function getStatus(): bool
    {
        if ($this->status instanceof StatusType) {
            return $this->status->value;
        }
        return $this->status;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function setFee(float $fee): void
    {
        $this->fee = $fee;
    }

    public function setStatus(StatusType $status): void
    {
        $this->status = $status;
    }

    public static function createFromEloquent(PaymentMethod $values): PaymentMethod
    {
        $payMethod = new self;
        $payMethod->setMethod($values['method']);
        $payMethod->setFee($values['fee']);
        $payMethod->setStatus($values['status']);

        return $payMethod;
    }
}
