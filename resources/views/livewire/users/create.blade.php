@push('title', 'Criar usuário')

<form wire:submit.prevent="submit">
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Adicionar usuário
    </x-button>
</form>
