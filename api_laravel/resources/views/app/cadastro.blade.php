<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Página de Cadastro de Usuário</title>
	<meta name="viewport" content="width=device-width user-scalable=no">


	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" type="text/css" media="screen and (min-width: 720px) and (max-height: 1360px)"  href="static/css/styles.css">
	


</head>
<body>

	 <div class="box-login">
	      <form class="form-login" method="POST" action="{{ route('app.form') }}">
           @csrf

		  <div class="topo-login" style="top: 8px">
			  <h3 style="font-size: 1.775rem; font-weigth: 800;">Cadastro de Usuário </h3>
			  <br>
			   <br> <br>
			</div>

	        <div class="row">
			<div class="input-field col nome" style="background: azure;position: absolute;top: 134px;
                width: 370px;left: 16px;}">
	            <span class="material-icons prefix">person_pin</span>
	             <input id="input_text" type="text" name="name"   >
				<label for="input_text">Nome</label>
				<span id="login_is_empty" style="display:none;">* Preencher o campo nome</span>
			</div>


	          <div class="input-field col  login">
	            <span class="material-icons prefix">person_pin</span>
	             <input id="input_text" type="text" name="email"  style="color: #000;" >

				<label for="input_text">E-mail</label>
				<span id="login_is_empty" style="display:none;">* Preencher o campo login</span>
			  </div>
			  
              <div class="input-field col  senha">
	            <span class="material-icons prefix">vpn_key</span>
	            <input id="input_text" type="password" name="password" style="color: #000;" >
				<label for="input_text">Senha</label>
				<span id="pass_is_empty" style="display:none;">* Preencher o campo senha</span>


			  </div>
			  
              <div class="input-field col  btn-acessar">
	          	 <button type="submit" class="" id="login" name="logar">Cadastrar</button>
	          </div>

			  <div class="input-field col flexrow-recover-links">
                <a href="{{ route('app.login') }}" class="flex-row-link-open">Voltar para o login >></a>
			  </div>
	        </div>
	      </form>
	 </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="static/js/login.js"></script>	

</body>
</html>