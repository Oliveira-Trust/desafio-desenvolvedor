<?php

namespace App\Models;

use App\Services\ComparatorService;
use App\Services\MoneyFormatterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvertionFeeRuleModel extends Model
{
    use HasFactory;

    protected $table = 'convertion_fee_rule';

    protected $fillable = [
        'comparator',
        'comparable_value',
        'fee',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function applyFee(float $value): float
    {
        return MoneyFormatterService::round($value * $this->fee);
    }

    public static function isOnRule(
        ConvertionFeeRuleModel $convertionFeeRuleModel,
        float $comparableValue
    ): bool {
        switch ($convertionFeeRuleModel->comparator) {
            case ComparatorService::LESS:
                return $comparableValue < $convertionFeeRuleModel->comparable_value;
            case ComparatorService::LESS_OR_EQUAL:
                return $comparableValue <= $convertionFeeRuleModel->comparable_value;
            case ComparatorService::EQUAL:
                return $comparableValue == $convertionFeeRuleModel->comparable_value;
            case ComparatorService::GREATER_OR_EQUAL:
                return $comparableValue >= $convertionFeeRuleModel->comparable_value;
            case ComparatorService::GREATER:
                return $comparableValue > $convertionFeeRuleModel->comparable_value;
            default:
                return false;
        }
    }
}
