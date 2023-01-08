<!DOCTYPE html>
<html>
<body>
    <div>

        <div style="margin-bottom: 2rem">
            <p>
                <strong>Moeda de origem: </strong>
                {{$data['origin_currency']['name']}} ({{$data['origin_currency']['code']}})
            </p>
            <p>
                <strong>Moeda de destino: </strong>
                {{$data['destination_currency']['name']}} ({{$data['destination_currency']['code']}})
            </p>
            <p>
                <strong>Forma de pagamento: </strong>
                {{$data['payment_method']['name']}}
            </p>
        </div>

        <div style="margin-bottom: 2rem">
            <p>
                <strong>Valor para conversão : </strong>
                R$ {{number_format($data['origin_value'],2,",",".")}}
            </p>
            <p>
                <strong>Valor usado para conversão: </strong>
                {{$data['destination_currency']['code']}} {{number_format($data['destination_exchange_rate'],2,",",".")}}
            </p>
            <p><strong>Taxa de pagamento : </strong>
                R$ {{number_format($data['payment_method_fee_value'],2,",",".")}}
            </p>
            <p><strong>Taxa de conversão : </strong>
                R$ {{number_format($data['exchange_fee_value'],2,",",".")}}
            </p>
            <p>
                <strong>Valor utilizado para conversão descontando as taxas: </strong>
                R$ {{number_format($data['origin_value_without_fees'],2,",",".")}}
            </p>
            <p>
                <strong>Valor comprado: </strong>
                {{$data['destination_currency']['code']}} {{number_format($data['purchased_value'],2,",",".")}}
            </p>
        </div>
    </div>
</body>
</html>
