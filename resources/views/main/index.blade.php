@extends('layouts.main')

@section('title', 'Conversor de Moedas')
@section('title-page', 'Conversor de Moedas')
@section('display-icon-titulo', 'display: none;')
@section('sub-item', 'Conversor de Moedas')
@section('dark', 'light-mode')
@section('collapse_sidebar', 'sidebar-collapse')
@section('name-page', 'Conversor de Moedas')
@section('display-vickSuporte', 'display: none;')
@section('place-image-title', 'col-sm-0')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="row" style="margin-left: 0; margin-right: 0;">
                <div class="col-sm-12"style="background:#E9E9E9; border-radius:10px 10px 0 0; padding:10px;">
                    <div class="row" >
                        <div class="col-sm-5">
                            <div class="input-group" style="box-shadow: rgb(0 0 0 / 24%) 0px 7px 10px; border-radius: 5px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>BRL</b></span>
                                </div>
                                <input type="text" class="form-control" id="valor"  data-thousands="." data-decimal="," style="box-shadow: none;" placeholder="Valor:">
                                <input class="form-control" type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                            </div>
                        </div>
                        <div class="col-sm-1">
                            <h3 style="text-align:center;">Para</h3>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control select2" id="moeda" name="moeda" >
                                <option value="">Selecione moeda de compra</option>
                                @foreach($moeda as $code => $name)
                                    @if($code != "BRL")
                                        <option value="{{ $code }}">{{ $name }}/{{$code}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-block btn-danger" title="Avançar para pagamento" onclick="pagamento('#valor','#moeda','#token')">
                                <i class="fad fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 0; margin-right: 0;">
                <div class="col-sm-12"style="background:#FFF; border: 1px solid #E9E9E9; border-radius: 0 0 10px 10px; padding:10px;">
                    <div class="row" id="aviso"></div>
                    <div class="row" id="conversao">
                        <div class="col-sm-12" style="text-align: center;">
                            <div class="card" style="display:block; border-radius: 5px; margin-bottom: 5px; box-shadow: none; border: 1px #eee solid;">
                                <h5>Faça agora sua simulação</h5>    
                                <button disabled style="width: 130px;height: 130px;font-size: 35px;padding: 0px;opacity: .8;text-align: center;border-radius: 166px;color: #ffffff;background: linear-gradient(45deg, #009B3A 25%, #FEDF00 47%, #073272 0%);outline:none;border: 2px solid #073272;/* box-shadow: rgb(153 153 153 / 70%) 0px 0px 0px 1px, rgb(153 153 153 / 27%) 0px 0px 0px 4px; */" type="button">
                                    R$ <i class="fas fa-exchange-alt "></i> ?
                                </button><br>
                                <h3>Informe o valor e a moeda para conversão.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

@stop