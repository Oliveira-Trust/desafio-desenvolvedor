<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public string $message;
    public string $status;
    public $show = false;

    #[On('success-alert')]
    public function show(string $status, string $message): void
    {
        $this->status = $status;
        $this->message = $message;
        $this->show = true;

        $this->dispatch('alert-show');
    }

    public function closeMessage(): void
    {
        $this->show = false;
    }

    public function render(): View
    {
        return view('livewire.components.alert');
    }
}
