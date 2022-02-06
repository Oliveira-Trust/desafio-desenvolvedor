@extends('layouts.app')
@section('title')
<h3>
    {{trans('home.title')}}
</h3>
@endsection
@section('content')
    @include('home.form')
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('site/css/home.css')}}">
@endpush
@push('js')
<script>
    $('body #form-coin-conversion').submit(() => {
        $('.error-coin-convert').html('').addClass('d-none')
        $('.success-coin-convert').html('').addClass('d-none')

        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer {{ session('token_api')}}',
            }
        });

        $.post('{{route('api.coin-convert')}}', {
            _token:             $('#token').val(),
            payment_method:     $('#payment_method').val(),
            currency:           $('#currency').val(),
            convertion_value:   $('#convertion_value').val(),
        })
        .done((data) => {
            console.log(data)
            $('.success-coin-convert').html('').removeClass('d-none')
            $.each(data, (i, v) => {
                $('.success-coin-convert').append(`<span> * ${v} </span>`)
            })

        })
        .fail((data) => {

            $('.error-coin-convert').html('').removeClass('d-none')

            if(data.responseJSON.message === "Unauthenticated.") {
                $('.error-coin-convert').append(`<span> {{trans('coin_convertion.error.unauthenticated')}} </span>`)
            }
            $.each(data.responseJSON.errors, (i, v) => {
                $('.error-coin-convert').append(`<span> * ${v} </span>`)
            })
        })

        event.preventDefault()
        console.log('OK')
    })
</script>
@endpush
