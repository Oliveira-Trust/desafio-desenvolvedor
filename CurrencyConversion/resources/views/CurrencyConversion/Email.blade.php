
<table class="table table-striped ">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

    </thead>
    <tbody>
        <tr>
            <td class="text-end">Data</td>
            <td class="fw-bold">{{$ConvertValue['created_at']}}</td>

        </tr>
        <tr>
            <td class="text-end">Destino</td>
            <td class="fw-bold">{{$ConvertValue->Currency->abbreviation}}</td>
        </tr>
        <tr>
            <td class="text-end">Valor</td>
            <td class="fw-bold">{{$ConvertValue->origin_value}}</td>
        </tr>
        <tr>
            <td class="text-end">Forma de Pagamento</td>
            <td class="fw-bold">{{$ConvertValue->payment_method}}</td>
        </tr>
        <tr>
            <td class="text-end">Cotação</td>
            <td class="fw-bold">{{$ConvertValue->tax_currency}}</td>
        </tr>
        <tr>
            <td class="text-end">Taxa De Pagamento</td>
            <td class="fw-bold">{{$ConvertValue->tax_payment_method}}</td>
        </tr>
        <tr>
            <td class="text-end">Taxa De Conversão</td>
            <td class="fw-bold">{{$ConvertValue->tax_conversion}}</td>
        </tr>
        <tr>
            <td class="text-end">Valor Com Desconto</td>
            <td class="fw-bold">{{$ConvertValue->updated_value}}</td>
        </tr>
        <tr>
            <td class="text-end">Valor Comprado</td>
            <td class="fw-bold">{{$ConvertValue->converted_value}}</td>
        </tr>
        <tr>
            <td class="text-end">Usuário</td>
            <td class="fw-bold">{{$ConvertValue->User->name}}</td>
        </tr>
        
    </tbody>
</table>





