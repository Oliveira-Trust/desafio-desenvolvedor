@push('title', 'Formas de pagamento')

<div class="flex flex-col justify-center gap-4">
    <div class="flex justify-end">
        <x-button
            href="{{ route('payment-method.create') }}"
            label="Adicionar forma de pagamento"
            primary
        />
    </div>
    <div class="overflow-hidden">
        {{ $this->table }}
    </div>
</div>
