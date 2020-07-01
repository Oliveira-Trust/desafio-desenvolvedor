<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">


    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/LoginUsuario.js"></script>

    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>


</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form" id="formCadastro">
					<span class="login100-form-title p-b-34">
						Cadastre-se
					</span>

                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                    <input id="first-name" class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="senha" placeholder="Senha">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" onclick="new LoginUsuario().cadastrar(); " type="submit">
                        Cadastrar
                    </button>
                </div>

                <div class="w-full text-center p-t-27 p-b-239">


                </div>

                <div class="w-full text-center">
                    <a href="../view/login.php" class="txt3">
                        Ja possui conta?
                    </a>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('../img/ot.png');  background-size: 500px 350px;"></div>
        </div>
    </div>
</div>



<script>
    $("#formCadastro").submit(function(e) {
        e.preventDefault();
    });
</script>


</body>
</html>