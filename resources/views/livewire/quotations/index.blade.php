@push('title', 'Cotações Realizadas')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('quotations.create') }}"
            label="Realizar cotação"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
