@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function() {
            $('#productSelect').select2();
        });
</script>
<div class="container">

    @include('order._orderDetails')

    @if ($order->status == 'Pedido em digitação')
    @include('order._insertProduct')
    @endif

    @include('order._listOrderProducts')
</div>



@endsection
