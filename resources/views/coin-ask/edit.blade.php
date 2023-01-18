@extends('layouts.app-master')

@section('template_title')
    Update Coin Ask
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Coin Ask</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('coin-asks.update', $coinAsk->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('coin-ask.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
