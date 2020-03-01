@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clients</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('clients')}}">Clients</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
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