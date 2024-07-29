<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Historico extends Component
{
    #[Reactive]
    public $operacao;
    
    public function mount($operacao) {
        $this->operacao = $operacao;
    }

    public function limpar() {
        $this->dispatch('limparHistorico');
    }

    public function render()
    {
        return view('livewire.historico');
    }
}
