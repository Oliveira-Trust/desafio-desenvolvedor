@push('title', 'Taxas de conversão')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('conversion-fees.create') }}"
            label="Adicionar taxa de conversão"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
