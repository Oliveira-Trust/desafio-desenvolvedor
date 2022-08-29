@push('title', 'Adicionar moeda de destino')

<form wire:submit.prevent="submit">
    <span class="block text-sm">
        Atenção: Por enquanto, as únicas moedas de destino suportadas para conversão, são: "USD", "BRL" e "EUR".
    </span>
    <span class="block text-sm mb-4">
        Quaisquer outras moedas de destino não serão dadas como opção de conversão ao usuário.
    </span>
    {{ $this->form }}

    <x-button
        class="mt-4"
        type="submit"
        spinner="submit"
        positive
    >
        Adicionar moeda de destino
    </x-button>
</form>
