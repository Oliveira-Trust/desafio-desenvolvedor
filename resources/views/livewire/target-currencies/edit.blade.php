@push('title', 'Editar moeda de destino')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Editar moeda de destino
    </x-button>
</form>
