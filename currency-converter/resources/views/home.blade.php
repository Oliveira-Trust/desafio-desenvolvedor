@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{\Request::route()->getName() == 'home' ? 'active' : ''}}" id="home-tab" href="{{route('home')}}" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{\Request::route()->getName() == 'history' ? 'active' : ''}}" id="history-tab" href="{{route('history')}}" role="tab" aria-controls="history" aria-selected="true">Histórico</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{\Request::route()->getName() == 'home' ? 'show active' : ''}}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @yield('form-quotation')
                </div>
                <div class="tab-pane fade {{\Request::route()->getName() == 'history' ? 'show active' : ''}}" id="history" role="tabpanel" aria-labelledby="history-tab">
                    @yield('history')
            </div>
        </div>

    </div>
</div>
@endsection
