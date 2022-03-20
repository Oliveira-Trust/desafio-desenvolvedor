@extends('default.base')

@section('title')
{{ trans('buy.title') }}   
@endsection

@section('content')
    @include('buy.form')
@endsection