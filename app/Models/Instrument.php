<?php declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Instrument extends Model
{
    protected $connection = 'mongodb';
    protected string $collection = 'instruments';
    protected $guarded = [];

    public function scopeByTicker($query, string $ticker)
    {
        return $query->where('TckrSymb', strtoupper($ticker));
    }

    public function scopeByDate($query, string $date)
    {
        return $query->where('RptDt', $date);
    }
}
