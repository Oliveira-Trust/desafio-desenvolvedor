@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
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
                        <form method="POST" action="{{route('ask-me')}}"  role="form" enctype="multipart/form-data">
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
