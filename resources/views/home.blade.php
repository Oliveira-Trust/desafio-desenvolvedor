@extends('layouts.app')

@section('style')
@parent
@endsection

@section('content')
{{-- <h1>{{ __('Dashboard') }}</h1> --}}
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Dashboard') }}</b>
        <div class="fa-pull-right">
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($infoCards as $infocard)
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $infocard['title']}} </h5>
                            <p class="card-text">
                                <p class="h2 d-inline">{{$infocard['amount']}}</p> {{ $infocard['text'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Order status')}}</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($infoBars as $infoBar)
                                <li class="list-group-item">
                                    <p class="h2 d-inline">{{$infoBar['title']}}</p>
                                    <div class="progress" style="height: 2px;">
                                        <div class="progress-bar {{$infoBar['bg']}}" role="progressbar" style="width: {{$infoBar['percentage']}}%;" aria-valuenow="{{$infoBar['percentage']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
@endsection
