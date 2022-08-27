@push('title', 'Moedas suportadas')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('currencies.create') }}"
            label="Adicionar moeda"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
