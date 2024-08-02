<?php

namespace App\View\Components\Tables;

use App\Querys\QuoteHistory\Tables\Dashboard;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Quotes extends Component
{
    public function render(): View
    {
        return view('components.tables.quotes', [
            'quotes' => Dashboard::run(),
        ]);
    }
}
