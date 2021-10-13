<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'range', 'less_than', 'more_than', 'description', 'status'];

    protected $casts = [
        'status' => StatusType::class
    ];

    private $type;
    private $range;
    private $less_than;
    private $more_than;
    private $description;
    private $status;

    public function getType(): string
    {
        return $this->type;
    }

    public function getRange(): float
    {
        return $this->range;
    }

    public function getLessThan(): float
    {
        return $this->less_than;
    }

    public function getMoreThan(): float
    {
        return $this->more_than;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): bool
    {
        if ($this->status instanceof StatusType) {
            return $this->status->value;
        }
        return $this->status;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setRange($range): void
    {
        $this->range = $range;
    }

    public function setLessThan($less_than): void
    {
        $this->less_than = $less_than;
    }

    public function setMoreThan($more_than): void
    {
        $this->more_than = $more_than;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setStatus(StatusType $status): void
    {
        $this->status = $status;
    }

    public static function createFromEloquent(array $values): Fee
    {
        $fee = new self;
        $fee->setType($values[0]['type']);
        $fee->setRange($values[0]['range']);
        $fee->setLessThan($values[0]['less_than']);
        $fee->setMoreThan($values[0]['more_than']);
        $fee->setDescription($values[0]['description']);
        $fee->setStatus(($values[0]['status'] === 0) ? StatusType::INACTIVATED() : StatusType::ACTIVATED());

        return $fee;
    }

}
