@extends('layouts.common.main')

@section('title', 'Configurações')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Configurações</h1>

        @include('admin::settings.partials.update-payment-methods-fees-form', [
            'boleto_fee' => $fees->formatted_boleto,
            'credit_card_fee' => $fees->formatted_credit_card,
        ])

        @include('admin::settings.partials.update-conversion-fees-form', [
            'less_than_3000' => $fees->formatted_less_than_3000,
            'more_than_3000' => $fees->formatted_more_than_3000
        ])
    </div>
@endsection
