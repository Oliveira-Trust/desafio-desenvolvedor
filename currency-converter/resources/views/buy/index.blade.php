@extends('default.base')

@section('title')
{{ trans('buy.title') }}   
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('buy.form')
            </div>
        </div>
    </div>
@endsection