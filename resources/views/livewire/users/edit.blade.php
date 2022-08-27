@push('title', 'Editar usuário')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Editar usuário
    </x-button>
</form>
