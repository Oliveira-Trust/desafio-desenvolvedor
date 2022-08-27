@push('title', 'Editar forma de pagamento')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Editar forma de pagamento
    </x-button>
</form>
