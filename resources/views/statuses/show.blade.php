@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header bg-dark text-light">
                    # {{ $status->id }}
                </div>
                <div class="card-body">
                    @include('statuses.show_fields')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection