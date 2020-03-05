
@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                {{ \Session::get('success') }}
            </div>
        @endif
            @if (\Session::has('errors'))
                <div class="alert alert-danger">
                    {{ \Session::get('errors') }}
                </div>
            @endif
        {{$table}}
    </div>
@endsection
