@extends('layouts.app')
@section('title', ucfirst(explode('/', Route::current()->uri)[0]))
@section('content')
    <div class="container">
        <h1>{{ucfirst(explode('/', Route::current()->uri)[0])}}</h1>
        @include('partials/sessionAlerts')
        <div class="row">            
            <div class="col-9 col-md-11">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ucfirst(explode('/', Route::current()->uri)[0])}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3 col-md-1 text-right">
                <a href="{{URL::to(explode('/', Route::current()->uri)[0].'/create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        
        <div class="row">            
            <div class="col-md-12">
                {{$table}}
            </div>
        </div>
    </div>
    

@endsection