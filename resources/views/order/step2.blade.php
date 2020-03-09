@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function() {
            $('#productSelect').select2();
        });
</script>
<div class="container">

        @include('order._orderDetails')
        @include('order._insertProduct')

        @include('order._listOrderProducts')


</div>



@endsection
