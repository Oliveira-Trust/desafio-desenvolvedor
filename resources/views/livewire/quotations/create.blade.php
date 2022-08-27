@push('title', 'Realizar cotação')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Realizar cotação
    </x-button>
</form>
