<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CurrencyHistoric extends Component
{
    use WithPagination;

    #[On('currency-created')]
    public function updateCurrencyList(): void
    {
        $this->render();
    }

    public function render(): View
    {
        return view('livewire.currency-historic', [
            'historic' => \App\Models\CurrencyHistoric::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(4),
        ]);
    }
}
