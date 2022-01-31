@extends('layout.app')
@section('content')
<form id="form-coin-conversion" class="container-coin-conversion">
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="payment_method" class="form-label">{{trans('home.label.payment_method')}}</label>
            <select id="payment_method" class="form-select">
                @foreach($config->getEnabledPayments() as $paymentMethod)
                <option value="{{$paymentMethod}}">{{trans('coin_convertion.success.array.payment_method.' . $paymentMethod)}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="currency" class="form-label">{{trans('home.label.currency')}}</label>
            <select id="currency" class="form-select">
                @foreach($config->getEnabledCurrencies() as $currency)
                <option value="{{$currency}}">{{trans('home.options.' . $currency)}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="convertion_value" class="form-label">{{trans('home.label.convertion_value')}}</label>
            <input type="number" class="form-control" id="convertion_value">
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Comprar</button>
</form>

<div class="row">
    <div class="alert alert-success result-coin-convert d-none"></div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('site/css/home.css')}}">
@endpush

@push('js')
<script>
    $('body #form-coin-conversion').submit(() => {
        event.preventDefault()
        console.log('OK')
    })
</script>
@endpush
