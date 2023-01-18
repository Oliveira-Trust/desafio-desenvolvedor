@extends('layouts.app-master')

@section('template_title')
    {{ $coinAsk->name ?? 'Show Coin Ask' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Coin Ask</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('coin-asks.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Coin Dest:</strong>
                            {{ $coinAsk->coin_dest }}
                        </div>
                        <div class="form-group">
                            <strong>Coin Base:</strong>
                            {{ $coinAsk->coin_base }}
                        </div>
                        <div class="form-group">
                            <strong>Value Of:</strong>
                            {{ $coinAsk->value_of }}
                        </div>
                        <div class="form-group">
                            <strong>Payment Method:</strong>
                            {{ $coinAsk->payment_method }}
                        </div>
                        <div class="form-group">
                            <strong>Ranting Ask:</strong>
                            {{ $coinAsk->ranting_ask }}
                        </div>
                        <div class="form-group">
                            <strong>Tax Convert:</strong>
                            {{ $coinAsk->tax_convert }}
                        </div>
                        <div class="form-group">
                            <strong>Tax Payment:</strong>
                            {{ $coinAsk->tax_payment }}
                        </div>
                        <div class="form-group">
                            <strong>Total Used:</strong>
                            {{ $coinAsk->total_used }}
                        </div>
                        <div class="form-group">
                            <strong>Total Dest:</strong>
                            {{ $coinAsk->total_dest }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $coinAsk->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
