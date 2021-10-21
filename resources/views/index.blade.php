@extends('layouts.main')

@section('content')
<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <form action="{{ route('buy') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="originCoin">Moeda de origem:</label>
                        <select class="form-select" name="origemMoeda">
                            <option value="BRL">Real Brasileiro</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="originCoin">Moeda de destino:</label>
                        <select class="form-select" name="destinoMoeda">
                            @forelse ($avaliables as $avaliable)
                                @if($avaliable['code'] !== 'BRL' )
                                    <option value="{{ $avaliable['code'] }}">{{ $avaliable['name'] }}</option>
                                @endif
                            @empty
                                <option>Nenhuma opção</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="valor">Valor para conversão:</label>
                        <input type="text" class="form-control" name="valor" id="valor">
                    </div>
                    <div class="col-6">
                        <label>Tipo de pagamento:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pagamento" id="boleto" value="boleto" checked>
                            <label class="form-check-label" for="boleto">
                                Boleto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pagamento" id="cartao" value="cartao">
                            <label class="form-check-label" for="cartao">
                                Cartão de Crédito
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary  mx-auto">Converter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
