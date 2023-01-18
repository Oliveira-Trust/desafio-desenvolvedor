@extends('layouts.app-master')

@section('template_title')
    Create Coin Ask
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Coin Ask</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('coin-asks.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('coin-ask.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
