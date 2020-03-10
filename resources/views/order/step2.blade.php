@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function() {
            $('#productSelect').select2();
        });
</script>
<div class="container">
        @desktop
        @include('order._orderDetails')
        @enddesktop
        @include('order._insertProduct')

        @include('order._listOrderProducts')


</div>



@endsection
