<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scriptChamadas.js') }}"></script>

    <title>Login</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">


            <div class="col-4">

                <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Login</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Cadastro</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">

                        <div class="card mt-5">
                            <div class="card-header bg-primary text-white">
                                <b>Login</b>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text"></p>

                                <form id="login" name="login" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <label for="email">Usuario:</label>
                                    <input class="form-control mb-3" type="email" id="emaillogin" name="email"
                                        required />

                                    <label for="senha">Senha:</label>
                                    <input class="form-control  mb-3" type="password" id="senhalogin" name="senha"
                                        required />
                                    <br>
                                    <button class="btn btn-primary mb-3" type="submit" id="enviarlogin"
                                        name="enviarlogin">Entrar</button>

                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">


                        <div class="card mt-5">
                            <div class="card-header bg-primary text-white">
                                <b>Cadastrar usuário</b>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text"></p>

                                <form id="cadastro" name="cadastro">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control mb-3" type="text" id="nome" name="nome"
                                        required />

                                    <label for="email">Email:</label>
                                    <input class="form-control mb-3" type="email" id="email" name="email"
                                        required />

                                    <label for="senha">Senha:</label>
                                    <input class="form-control  mb-3" type="password" id="senha" name="senha"
                                        required />

                                    <label for="confirmasenha">Confirme a senha:</label>
                                    <input class="form-control  mb-3" type="password" id="confirmasenha"
                                        name="confirmasenha" required />
                                    <br>
                                    <button class="btn btn-primary mb-3" id="enviar" name="enviar"
                                        onclick="cadastrarUsuario()">Cadastrar usuário</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>


    </div>
    </div>

</body>

</html>
