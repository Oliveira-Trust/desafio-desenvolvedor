@extends('template.template')

@section('title','Adson Conversor - Home')

@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <div class="card cardConversor">
                    <div>

                    </div>
                    <div class="card-body">
                        <i class="far fa-money-bill-alt" title=""></i>
                        <h5 class="card-title">Cotação de moedas</h5>

                        <form method="POST" id="formCotar" action="{{route('cotacao')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <select class="form-control" name="padrao" id="padrao"  readonly="readonly">

                                            @foreach($moedaPadrao as $padrao)
                                                <option value="{{$padrao}}">{{$padrao}}</option>
                                            @endforeach
                                        </select>
                                        <span>R$:1.00</span>
                                    </div>
                                </div>
                                <div class="col-sm-2 colArrow">
                                    <i class="fas fa-arrow-right" title="Converter para"></i>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <select class="form-control" name="liberada" id="liberada">
                                            @foreach($moedasLiberadas as $liberadas)
                                                <option value="{{$liberadas->code}}">{{$liberadas->code}}</option>
                                            @endforeach
                                        </select>
                                        <span id="valorliberada">R$:0,00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-12">
                                    <span>Valor para compra</span>
                                    <div class="form-group">
                                        <input type="text"  class="form-control" name="valor_compra" id="valor_compra" maxlength="6" placeholder="R$:">
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    Forma de Pagamento
                                    <div class="form-group">
                                        <select class="form-control" name="forma_pagamento" >
                                            @foreach($formas_pagamento as $pagamento)
                                                <option value="{{$pagamento}}">{{$pagamento}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <input type="hidden" name="valor_moeda_liberada" id="valor_moeda_liberada" />
                            <button type="submit" class="btn btn-primary botaoCotar">Cotar</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>

    <script>

        function newRequest(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                type:'GET',
                url:"/consulta",

                success:function(data){
                    var json = JSON.parse(data);
                    var selecionada = $('#liberada').val()+''+$('#padrao').val();
                    $('#valorliberada').text("R$: "+Number(json[selecionada]['bid']).toFixed(2));
                    $('#valor_moeda_liberada').val(Number(json[selecionada]['bid']).toFixed(2))
                    $('#valorliberada').css("color", "red");
                    setTimeout(function() {
                        $('#valorliberada').css("color", "black");
                    }, 2000);

                },
                error:function(){
                    alert('Erro');
                },
                complete:function (){
                    setTimeout(function() {
                        newRequest();
                    }, 30000);
                }
            });
        }


        $(document).ready(function(){
            newRequest();

            $('#liberada').on('change', function(e){
                newRequest();
            });

            $( "#formCotar" ).submit(function( event ) {
               if($('#valor_compra').val() < 1000 || $('#valor_compra').val() > 100000){
                  alert('Valor mínimo para compra é de R$: 1.000,00 e máximo de R$: 100.000,00');
                   event.preventDefault();
               }
            });

            function checkChar(e) {
                var char = String.fromCharCode(e.keyCode);

                var pattern = '[0-9]';
                if (char.match(pattern)) {
                    return true;
                }

            }

            $( "#valor_compra" ).keypress(function(e) {
                if(!checkChar(e)) {
                    e.preventDefault();
                }
            });

        });

    </script>
@endsection
