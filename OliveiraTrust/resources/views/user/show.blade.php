@extends('index')

@section('content')
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card" style = "margin: 8% 0 0; width: 40%;">
			<div class="card-header">
				<h3>Cadastrar-se</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
                @if($errors->any())
                <div class = "alert alert-danger mt-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form role="form" method = "post" action = "{{ route('create.user') }}">
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name = "name" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name = "email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name = "password" placeholder="Senha">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-center">
            <a href="#">Redefinir senha</a>
        </div>
    </div>
</div>
</div>
</div>
@endsection
