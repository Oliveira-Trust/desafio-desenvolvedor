@extends('layouts.guest')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <img src="{{asset('imgs/base_logo.png')}}" alt="" class="responsive">
        </div>
    </div>    
    <div class="row">
        <div class="col-12">
            <h5>Últimas cotações:</h5>
            <table class="table">
                <thead>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Compra</th>
                    <th>Tarifa Compra</th>
                    <th>Tarifa Conv.</th>
                </thead>
                <tbody>
                    @foreach (auth()->user()->exchanges()->take(5)->get() as $exchange)
                        <tr>
                            <td>{{$exchange->created_at->format('d/m/Y H:i')}}</td>
                            <td>{{$exchange->ask}} {{$default_isocode}}</td>
                            <td>{{$exchange->amount}} {{$exchange->currency->isocode}}</td>
                            <td>{{$exchange->total_payment_tax}} {{$default_isocode}}</td>
                            <td>{{$exchange->total_exchange_tax}} {{$default_isocode}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('custom_styles')

@endpush

@push('custom_scripts')
<script>
    
</script>
@endpush