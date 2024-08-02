@props([
    'data' => [],
])

<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">
    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Detalhes da sua conversão</h5>

    <x-cards.converted-card.converted-item label="Moeda de Origem">
        {{ $data['origin_currency'] }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Moeda de Destino">
        {{ $data['destination_currency'] }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Valor para Conversão">
        R$ {{ number_format($data['amount'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Forma de Pagamento">
        {{ $data['payment_title'] }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Preço de Compra">
        {{ App\Enums\Currencies::symbol($data['destination_currency']) }}
        {{ number_format($data['purchase_price'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Valor da Moeda de Destino">
        R$ {{ number_format($data['destination_value'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Valor Comprado">
        {{ App\Enums\Currencies::symbol($data['destination_currency']) }}
        {{ number_format($data['converted_value'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Taxa de Pagamento">
        R$ {{ number_format($data['payment_tax'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Taxa de Conversão">
        R$ {{ number_format($data['conversion_tax'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>

    <x-cards.converted-card.converted-item label="Valor Utilizado para Conversão">
        R$ {{ number_format($data['converted_amount'], 2, ',', '.') }}
    </x-cards.converted-card.converted-item>
</div>
