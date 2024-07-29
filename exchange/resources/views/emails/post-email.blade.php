<div style="font-family: Arial, sans-serif; margin: 20px;">
    <h2>Detalhes da Conversão de Moeda</h2>
    <div>
        <p><strong>Moeda de origem:</strong> {{ $data['exchange']['origin_currency'] }}</p>
    </div>
    <div>
        <p><strong>Moeda de destino:</strong> {{ $data['exchange']['destination_currency'] }}</p>
    </div>
    <div>
        <p><strong>Valor para conversão:</strong> R$ {{ number_format($data['exchange']['amount'], 2, ',', '.') }}</p>
    </div>
    <div>
        <p><strong>Forma de pagamento:</strong> {{ ucfirst(str_replace('_', ' ', $data['exchange']['payment_method'])) }}</p>
    </div>
    <div>
        <p><strong>Valor da {{ $data['exchange']['destination_currency'] }} usado para conversão:</strong> $ {{ number_format($data['exchange']['exchange_rate'], 2, ',', '.') }}</p>
    </div>
    <div>
        <p><strong>Valor comprado em {{ $data['exchange']['destination_currency'] }}:</strong> $ {{ number_format($data['exchange']['converted_amount'], 2, ',', '.') }}</p>
    </div>
    <div>
        <p><strong>Taxa de pagamento:</strong> R$ {{ number_format($data['exchange']['payment_fee'], 2, ',', '.') }}</p>
    </div>
    <div>
        <p><strong>Taxa de conversão:</strong> R$ {{ number_format($data['exchange']['conversion_fee'], 2, ',', '.') }}</p>
    </div>
    <div>
        <p><strong>Valor utilizado para conversão descontando as taxas:</strong> R$ {{ number_format($data['exchange']['final_amount_for_conversion'], 2, ',', '.') }}</p>
    </div>
</div>
