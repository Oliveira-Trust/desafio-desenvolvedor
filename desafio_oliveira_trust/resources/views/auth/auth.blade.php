<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="margin-top:30px">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Login</strong></h3></div>
            <div class="panel-body">
                <form class="" action="{{route('login')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username or Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-sm btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Register</strong></h3></div>
            <div class="panel-body">
                <form class="" action="{{route('register')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nome</label>
                        <input name="name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirmar Senha</label>
                        <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmar Senha">
                    </div>
                    <button type="submit" class="btn btn-sm btn-default">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
