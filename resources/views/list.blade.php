@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Grid de {{ucfirst(explode('/', Route::current()->uri)[0])}}
                    <div class="text-right float-right">
                            <a href="{{URL::to(explode('/', Route::current()->uri)[0].'/create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                        </div>
            </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                   {{$table}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
