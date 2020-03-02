@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ucfirst(explode('/', Route::current()->uri)[0])}}</h1>
        <div class="row">
            <div class="col-9 col-md-11">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to(explode('/', Route::current()->uri)[0])}}">{{ucfirst(explode('/', Route::current()->uri)[0])}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3 col-md-1 text-right">
            <a href="{{URL::to(explode('/', Route::current()->uri)[0])}}" class="btn btn-primary"><i class="fas fa-level-up-alt"></i></a>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials/errors')
                
                <div class="card">
                    <div class="card-header">{{ __('Create Client') }}</div>
                    <div class="card-body">
                        @if (isset($model->id))
                            <form action="{{'/'.explode('/', Route::current()->uri)[0].'/'.$model->id}}" method="post">
                                @method('PUT')
                        @else
                            <form action="{{'/'.explode('/', Route::current()->uri)[0]}}" method="post">
                        @endif
                            @csrf
                            @include(explode('/', Route::current()->uri)[0].'._form')
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="far fa-save"></i>
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection