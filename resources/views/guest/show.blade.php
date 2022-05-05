@extends('layouts.guest')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <img src="{{asset('imgs/base_logo.png')}}" alt="" class="responsive">
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6">
            <h5>Aqui estão os detalhes da sua cotação:</h5>
            <br>
            <p>Moeda de origem: {{$default_isocode}}</p>
            <p>Moeda de destino: {{$exchange->currency->isocode}}</p>
            <p>Valor para conversão: {{$exchange->ask}} {{$default_isocode}}</p>
            <p>Forma de pagamento: {{$exchange->payment->name}}</p>
            <p>Cotação ({{$exchange->currency->isocode}}): {{$exchange->rate}} {{$default_isocode}}</p>
            <p>Valor comprado: {{$exchange->amount}} {{$exchange->currency->isocode}}</p>
            <p>Taxa de pagamento: {{$exchange->total_payment_tax}} {{$default_isocode}}</p>
            <p>Taxa de conversão: {{$exchange->total_exchange_tax}} {{$default_isocode}}</p>
            <p>Valor utilizado para conversão descontando as taxas: {{$exchange->ask_amount}} {{$default_isocode}}</p>
        </div>
        <div class="col-md-6 mt-4 mt-md-0 text-center">   
            @auth                                        
            @if (auth()->user()->exchanges()->count() > 0)                
                <h5>Últimas cotações:</h5>
                <table class="table">
                    <thead>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Compra</th>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->exchanges()->take(5)->get() as $exchange)
                            <tr>
                                <td>{{$exchange->created_at->format('d/m/Y H:i')}}</td>
                                <td>{{$exchange->ask}} {{$default_isocode}}</td>
                                <td>{{$exchange->amount}} {{$exchange->currency->isocode}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <a class="btn btn-secondary" href="{{route('exchange.email', ['exchange_id' => $exchange->id])}}">Receber cotação por e-mail</a>                
            @else
            <h5>Gostaria de ver o histórico de cotações <br>ou receber por e-mail?</h5>            
            <a href="{{ route('login') }}" class="nav-link">Faça o Log in</a>            
            @if (Route::has('register'))            
                <a href="{{ route('register') }}" class="nav-link">Ou crie uma conta</a>            
            @endif
            @endauth         
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