<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Cálculo Comissão</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
            <div class="container" style="background-color:white; height: 60%; width:60%; border-radius: 10px; padding:50px">
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
                                    <option value="BTC">BTC - Bitcoin</option>
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
                        </div>                                            
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="imagem" style="text-align: center">
                                    <img src="{{asset('images/img-01.png')}}" alt="IMG" style="margin-top:8%">
                                </div>                                
                            </div>
                        </div>                                           
                    </div>
                </div>       
            </div>
                
                
				<!-- <div class="login100-pic">
					<img src="{{asset('images/img-01.png')}}" alt="IMG">
					<div class="text-center" style="padding-top: 40px;">
                      <div id="loading"></div>
                    </div>

				</div>
				<div  class="login100-form">
					<span class="login100-form-title">
						Cálculo Comissão
					</span>
					<span style="color: #57b846;" class="login100-form-title">
						Preço de Venda
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Insira seu salário.">
						<input class="input100" type="text" name="precoDeVenda" id="precoDeVenda"  placeholder="000,00" maxlength="9"  onKeyPress="return(moeda(this,'.',',',event))" autocomplete="off" onfocus="this.value=''">						
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i aria-hidden="true">R$</i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" id="calcularComissao" value="calcular comissão" >													
					</div>

					<div class="container-login100-form-btn">
						<input type="button" class="login100-form-btn-limpar"  onClick="window.location.reload()" value="limpar" >													
					</div>

					<div class="text-center"><i class="fa fa-ellipsis-h fa-2x" aria-hidden="true" style="padding-top: 20px;" ></i></div>
					
					<div id="retornoCalculo"></div>

				</form> -->			
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('js/base.js')}}"></script>
    <script src="{{asset('js/conversor.js')}}"></script>

</body>
</html>