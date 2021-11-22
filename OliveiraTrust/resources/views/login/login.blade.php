@extends('index')

@section('content')
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card" style = "margin: 8% 0 0; width: 40%;">
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
            <form method="POST" action="{{ route('logar') }}">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name = "email" placeholder="Email">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name = "password" placeholder="Senha">
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-primary float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Não possui conta?<a href="{{ route('show.user') }}">Criar</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Redefinir senha</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
