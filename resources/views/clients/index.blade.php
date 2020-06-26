@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('flash::message')

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    @include('clients.table')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
</div>
@endsection