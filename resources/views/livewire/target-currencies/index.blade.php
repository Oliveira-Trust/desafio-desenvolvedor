@push('title', 'Moedas de destino suportadas')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('target-currencies.create') }}"
            label="Adicionar moeda de destino"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
