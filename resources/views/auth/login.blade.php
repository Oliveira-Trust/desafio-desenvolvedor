@include('stack.script')
@stack('scripts-axios')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Log in</title>
    @stack('stylesheet-sign-in')

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-4 tect-center">
            </div>
            <div class="col-4 text-center mt-5">
                <form class="form-signin" onsubmit="return false;">
                    <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
                    <label for="inputEmail" class="sr-only">Email</label>
                    <input type="email" id="inputEmail" class="form-control mt-1" placeholder="Email address" required autofocus>
                    <br>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control mt-1" placeholder="Password" required>
                    <br>
                    <a class="btn btn-link" href="{{ url('register')}}" role="button">Cadastrar?</a>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" id="btn_sub">Log in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
                </form>
            </div>
            <div class="col-4 tect-center">
            </div>
        </div>
    </div>

    <script type="module">
        document.getElementById('btn_sub').addEventListener('click', authLogin);

        function authLogin() {

            let intputEmail = document.getElementById('inputEmail').value;
            let intputPassword = document.getElementById('inputPassword').value;

            if (intputEmail.length > 0 && intputPassword.length >= 5) {

                var config = axios.create({
                    baseURL: "{{ url('api/v1/')}}",
                    timeout: 1000,
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                config({
                    method: 'POST',
                    url: (1) ? "/login" : "{{ url('api/v1/login')}}",
                    data: {
                        email: intputEmail,
                        password: intputPassword
                    }
                }).then(function(response) {

                    var success = response.data.data.name;
                    var error = response.data.message.error;
                    if(error)
                        alert("Usuário não existe cadastrado!");
                        window.location.href = "{{ url('exchange')}}";
                    localStorage.setItem('token_gio', response.data.data.token);

                }).catch(err => console.log(err));

            } else {
                alert("This password which input is much short!");
            }

        }
    </script>
</body>

</html>