<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<div class="container" style="margin-top:30px">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Conversão</strong></h3></div>
            <div class="panel-body">
                <form class="" action="{{route('conversao')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Valor BRL</label>
                        <input name="valor_brl" type="text" class="form-control" id="valor_brl" placeholder="" onKeyUp="mascaraMoeda(this, event)">
                    </div>
                    <div class="form-group">
                        <label for="">Selecione a Moeda Para Conversão</label>
                        <select name="moeda_converter" class="form-control" required>
                            <option disabled selected>Selecione a Moeda</option>
                            @foreach( $moedas as $key => $moeda )
                                <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Forma de Pagamento</label>
                        <select name="forma_pagamento" class="form-control" required>
                            <option disabled selected>Selecione a Forma de Pagamento</option>
                                <option value="Boleto">Boleto</option>
                                <option value="Cartão de Crédito"> Cartão de Crédito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Receber Cotação por Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Informe o Email">
                    </div>
                    <button type="submit" class="btn btn-sm btn-default">Submeter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h3>Histórico</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Cotação</th>
            </tr>
            @foreach( $cotacoes as $cotacao )
            <tr>
                    <td>{{$cotacao->id}}</td>
                    <td>{{$cotacao->cotacoes}}</td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

<script>
    String.prototype.reverse = function(){
        return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "##.###.###,##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
                resultado += mascara.charAt(x);
                x++;
            } else {
                resultado += valor.charAt(y);
                y++;
                x++;
            }
        }
        campo.value = resultado.reverse();
    }
</script>