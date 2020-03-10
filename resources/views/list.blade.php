@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">{{ucfirst(explode('/', Route::current()->uri)[0])}}s
            {{-- <div class="text-right float-right">
                <a href="{{URL::to(explode('/', Route::current()->uri)[0].'/create')}}" class="btn btn-success"><i
                        class="fas fas fa-plus-circle fa-fw "></i> Create</a>
            </div> --}}
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


@endsection
