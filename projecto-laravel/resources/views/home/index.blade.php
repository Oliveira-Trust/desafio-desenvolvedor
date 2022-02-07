@extends('layouts.app')
@section('title')
<h3>
    {{trans('home.title')}}
</h3>
@endsection

@section('content')

    @if(auth()->user()->type == 'admin')
        @include('config.form', ['config'=>$config])
    @endif

    @include('home.form')
    <hr>
    <h4>{{trans('coin_convertion.title-historic')}}</h4>
    <table id="table-historic" class="table-xl table-bordered table-hover">
        <thead>
            <tr>
                <th>{{trans('coin_convertion.table.head.origin')}}</th>
                <th>{{trans('coin_convertion.table.head.destin')}}</th>
                <th>{{trans('coin_convertion.table.head.payment')}}</th>
                <th>{{trans('coin_convertion.table.head.value_to_convert')}}</th>
                <th>{{trans('coin_convertion.table.head.purchased_total')}}</th>
                <th>{{trans('coin_convertion.table.head.date')}}</th>
            </tr>
        </thead>
        <tbody>
            @include('home.table-historic')
        </tbody>
    </table>
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
        }).done((data) => {

            $('.success-coin-convert').html('').removeClass('d-none')
            $.each(data, (i, v) => {
                $('.success-coin-convert').append(`<span> * ${v} </span>`)
            })

            $.get('{{route('refresh-historic')}}').done((data) => {
                $('#table-historic tbody').html(data)
            }).fail((data) => {
                alert('{{trans('coin_convertion.table.error')}}')
            })

        }).fail((data) => {

            $('.error-coin-convert').html('').removeClass('d-none')

            if(data.responseJSON.message === "Unauthenticated.") {
                $('.error-coin-convert').append(`<span> {{trans('coin_convertion.error.unauthenticated')}} </span>`)
            }
            $.each(data.responseJSON.errors, (i, v) => {
                $('.error-coin-convert').append(`<span> * ${v} </span>`)
            })
        })

        event.preventDefault()

    })
</script>
@endpush
