@push('title', 'Editar taxa de conversão')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Editar taxa de conversão
    </x-button>
</form>
