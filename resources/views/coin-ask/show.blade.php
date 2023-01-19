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
                            <span class="card-title">Cotação Realizada com sucesso</span>
                        </div>
                      
                    </div>

                    @include('coin-ask.asked')

                </div>
            </div>
        </div>
    </section>
@endsection
