<?php

namespace App\Querys\QuoteHistory\Tables;

use App\Models\QuoteHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class Dashboard
{
    public static function make(): self
    {
        return app(static::class);
    }

    public static function run(): Paginator
    {
        return static::make()->query();
    }

    public function query(): Paginator
    {
        return QuoteHistory::query()
            ->when(! auth()->user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->leftJoin('users', 'users.id', '=', 'quote_histories.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'quote_histories.payment_method_id')
            ->select(
                'users.name as user_name',
                'payment_methods.name as payment_method_name',
                'quote_histories.origin_currency',
                'quote_histories.destination_currency',
                'quote_histories.amount',
                'quote_histories.converted_value'
            )->toBase()->simplePaginate(10);
    }
}
