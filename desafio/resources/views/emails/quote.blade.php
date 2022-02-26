<header style="width:100%;">
    <img src="{{ asset('assets/images/logo-oliveiratrust.png') }}" style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;">
</header>

<table style="border: 1px solid #ccc; padding: 10px; width: 100%; background: #f1f1f1; margin-top: 25px; border-collapse: collapse;">
    <tbody>
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">MOEDA BASE</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->code }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">MOEDA COMPRA</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->code_in }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">FORMA PAGAMENTO</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->payment_method }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">VALOR COTADO</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->conversion_value }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">VALOR MOEDA</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->destination_currency_value }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">TAXA MEIO DE PAGEMENTO</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->payment_rate }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">TAXA CONVERSÃO</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->conversion_rate }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">VALOR CONVERSÃO SEM TAXAS</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->conversion_value_tax }}</td>
        </tr>

        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; text-align: left; width: 50%;">VALOR COMPRADO</td>
            <td style="padding: 10px; border-bottom: 1px solid #ccc; text-align: left;">{{ $quote->purchased_value }}</td>
        </tr>
    </tbody>
</table>