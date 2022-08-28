@push('title', 'Adicionar taxa de conversão')

<form wire:submit.prevent="submit">
    <span class="mb-4 block text-sm">Ex.: Taxa de x% para valores menores ou iguais a x</span>
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Adicionar taxa de conversão
    </x-button>
</form>
