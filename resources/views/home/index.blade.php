@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Seja bem vindo {{auth()->user()->name}}.</p>
        
        <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Faça uma cotação conosco</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('coin-ask-public')}}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('home.coin-form')

                        </form>
                    </div>
                </div>

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        Seja bem vindo 
<div class="container">
<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Faça uma cotação conosco</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('coin-ask-public')}}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('home.coin-form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

        @endguest
    </div>
@endsection
