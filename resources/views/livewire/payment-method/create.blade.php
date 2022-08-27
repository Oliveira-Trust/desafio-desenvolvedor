@push('title', 'Adicionar forma de pagamento')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Adicionar forma de pagamento
    </x-button>
</form>
