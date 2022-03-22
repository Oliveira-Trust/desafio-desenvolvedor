@extends('default.base')

@section('title')
{{ trans('buy.title') }}   
@endsection

@include('buy.session-notifications')

@section('content')
    @include('buy.form')
@endsection