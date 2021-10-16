@extends('layouts.main')

@section('content')
<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-12">
            <form action="">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label for="originCoin">Moeda de origem:</label>
                        <select class="form-select" name="originCoin">
                            @forelse ($avaliables as $avaliable)
                                <option value="{{ $avaliable['code'] }}" {{ $avaliable['code'] === 'BRL' ? 'selected' : '' }}>{{ $avaliable['name'] }}</option>
                            @empty
                                <option>Nenhuma opção</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="originCoin">Moeda de destino:</label>
                        <select class="form-select" name="destCoin">
                            @forelse ($avaliables as $avaliable)
                                <option value="{{ $avaliable['code'] }}">{{ $avaliable['name'] }}</option>
                            @empty
                                <option>Nenhuma opção</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
