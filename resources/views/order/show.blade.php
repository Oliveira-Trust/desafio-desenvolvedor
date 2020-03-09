@extends('layouts.app')

@section('content')

<div class="container">

    @include('order._orderDetails', ['action'=>'show'])

    @include('order._listOrderProducts', ['action'=>'show'])
</div>



@endsection
