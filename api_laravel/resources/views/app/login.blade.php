<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width user-scalable=no">


	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" type="text/css" media="screen and (min-width: 720px) and (max-height: 1360px)"  href="static/css/styles.css">
	


</head>
<body>

	 <div class="box-login">
	      <form class="form-login" method="POST" action="{{ route('app.login') }}">
          @csrf

		  <div class="topo-login">
			   <img src="{{ asset('image/auto_awesome_white_48dp.svg') }}" alt="" srcset="">
			</div>

	        <div class="row">
	          <div class="input-field col  login">
	            <span class="material-icons prefix">person_pin</span>
	             <input id="input_text" type="text" name="email"  style="color: #000;" value="{{ old('email') }}">

				<label for="input_text">E-mail</label>
				<span id="login_is_empty" style="display:none;">* Preencher o campo login</span>

               <span style="color: red;">  {{ $errors->has('email') ? $errors->first('email') : ''}} </span>

			  </div>
			  
              <div class="input-field col  senha">
	            <span class="material-icons prefix">vpn_key</span>
	            <input id="input_text" type="password" name="senha" style="color: #000;" {{ old('password') }}>
				<label for="input_text">Senha</label>
				<span id="pass_is_empty" style="display:none;">* Preencher o campo senha</span>

                 <span style="color: red;"> {{ $errors->has('password') ? $errors->first('password') : ''}} </span>

			  </div>
			  
              <div class="input-field col  btn-acessar">
	          	 <button type="submit" class="" id="login" name="logar">continuar</button>
	          </div>

			  <div class="input-field col flexrow-recover-links">
			    <a href="#" class="key-link">Esqueci minha senha >></a>
                <a href="#" class="flex-row-link-open">Ainda não sou cliente >></a>
                
			  </div>
	        </div>
	      </form>
	 </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="static/js/login.js"></script>	

</body>
</html>