@push('title', 'Moedas de origem')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('source-currencies.create') }}"
            label="Adicionar moeda de origem"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
