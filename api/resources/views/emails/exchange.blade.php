<!DOCTYPE html>
<html>
    <body>
        <div>
        <div>
            <p><strong>Moedas</strong>{{exchange.exchange_name}}</p>
            <p><strong>Valor origem</strong> {{exchange.value}}</p>
            <p><strong>Valor da moeda destino</strong> ${{exchange.bid}}</p>
            <p><strong>Taxa de pagamento</strong> ${{exchange.payment_method_rate_discount}}</p>
            <p><strong>Taxa de conversão</strong> ${{exchange.conversion_rate_discount}}</p>
            <p><strong>Valor utilizado para conversão descontando as taxas</strong> ${{exchange.discounted_value}}</p>
            <p><strong>Valor recebido</strong> ${{exchange.converted_value}}</p>
            <p><strong>Metodo de pagamento</strong> {{exchange.method}}</p>
            <p><strong>Data/hora da simulação</strong> {{exchange.exchange_date_time}}
          </div>
        </div>
    </body>
</html>
