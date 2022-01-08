<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Cálculo Comissão</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<!--===============================================================================================-->	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>	
	<div class="limiter">   
		<div class="container-back">
            <div class="container" style="color:white; text-align: center">
                <h1>Conversor de Moeda</h1>
            </div>
            <div class="container painel">
                <div class="row">
                    <div class="col-6">
                        <div class="row" style="border-right: solid 1px #C6C6C6">
                            <div class="col-12">
                                <span>Moeda de origem: <strong>BRL - Brasil</strong></span>
                            </div>
                            <div class="col-12" style="margin-top:25px">
                                <span>Moeda de destino:</span>
                                <select class="form-control" id="moedaDestino" style="width:60%; margin-top:5px">
                                    <option selected value="0">Selecione a moeda</option>
                                    <option value="USD">USD - Dólar Americano</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="GBP">GBP - Libra Esterlina</option>
                                </select>
                            </div>
                            <div class="col-12" style="margin-top:25px">
                                <span>Valor para conversão:</span>
                                <input type="text" class="form-control" id="valor" placeholder="000,00" maxlength="9"  onKeyPress="return(moeda(this,'.',',',event))" autocomplete="off" onfocus="this.value=''" style="width:60%; margin-top:5px">
                            </div>
                            <div class="col-12" style="margin-top:25px">
                                <span>Forma de pagamento:</span>
                                <div class="row" style="margin-left:10px">
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pagamento" id="boleto" value="1" checked>
                                            <label class="form-check-label" for="boleto" style="padding-left:5px">
                                                Boleto
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pagamento" id="cartao" value="2">
                                            <label class="form-check-label" for="cartao" style="padding-left:5px">
                                                Cartão de crédito
                                            </label>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                            <div class="col-12" style="margin-top:25px">
                                <button type="button" class="btn btn-success" id="converter" style="cursor:pointer;">Converter</button>
                            </div>
                            <div class="col-12 email" style="margin-top:25px; padding-top:15px; display:none; border-top: solid 1px #C6C6C6">
                                <span>Enviar cotação por e-mail:</span>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="email" class="form-control" placeholder="e-mail" id="email" style="margin-top:5px">
                                    </div>
                                    <div class="col-5">
                                        <button type="button" class="btn btn-primary" id="enviarEmail" style="cursor:pointer; margin-top:5px">Enviar email</button>
                                        <div class="loading-sm"></div>
                                    </div>
                                </div>                              
                            </div>
                        </div>                                            
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 imagem">
                                <div style="text-align: center">
                                    <img src="{{asset('images/img-01.png')}}" alt="IMG" style="margin-top:8%">
                                </div>                                
                            </div>
                            <div class="col-12" id="loading" style="text-align: center; padding-top: 40px; display:none"></div>
                            <div class="col-12 result" style="display: none">
                                <div class="row">
                                    <div class="col-12" style="font-size:24px; text-align:center;">
                                        <strong>- Resultado -</strong>
                                    </div>
                                    <div class="col-12">
                                        <strong>Moeda de origem: </strong><span>BRL</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Moeda de destino: </strong><span id="resultDestino">USD</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Valor para conversão: </strong><span id="resultValor">R$ 000,00</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Forma de pagamento: </strong><span id="resultPg">Boleto</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Taxa de pagamento: </strong><span id="resultTaxaPg">R$ 0,00</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Taxa de conversão: </strong><span id="resultTaxaCv">R$ 0,00</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Valor para conversão descontado as taxas: </strong><span id="resultDescontos">R$ 0,00</span>
                                    </div>
                                    <div class="col-12 mt15">
                                        <strong>Valor da moeda de destino: </strong><span id="resultValorDestino">$ 0,00</span>
                                    </div>
                                    <div class="col-12 mt15" style="font-size:18px">
                                        <strong>Valor comprado em moeda de destino: </strong><span id="resultValorFinal" style="color:#28A745">$ 0,00</span>
                                    </div>
                                    <div class="col-12 mt25" style="text-align:center;">
                                        <button type="button" class="btn btn-secondary" id="limpar" onClick="window.location.reload()" style="cursor:pointer; margin-top:5px">Limpar Dados</button>
                                    </div>
                                </div>                      
                            </div>                           
                        </div>                                           
                    </div>
                </div>       
            </div>		
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('js/base.js')}}"></script>
    <script src="{{asset('js/conversor.js')}}"></script>
    <script src="{{asset('js/email.js')}}"></script>

</body>
</html>