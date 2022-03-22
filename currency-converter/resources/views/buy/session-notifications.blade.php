<div class="container-fluid">
    <div class="row">

        @if(session('buyStatus'))
        <h1>Purchase Details {{session('buyStatus')->origin_currency. '-' . session('buyStatus')->destination_currency}}</h1>
        <p class="msg">Payment Type: {{session('buyStatus')->payment_type}}</p>
        <p class="msg">Payment Value: {{session('buyStatus')->value}}</p>
        <p class="msg">Convertion Fee: {{session('buyStatus')->convertion_fee}}</p>
        <p class="msg">Payment Fee: {{session('buyStatus')->payment_fee}}</p>
        <td></td>
        <p class="msg">Total Received: {{session('buyStatus')->selling_price}}</p>
        @endif

    </div>
</div>