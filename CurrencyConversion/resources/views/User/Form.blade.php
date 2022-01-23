<div class="Group container">

	<div class="row mb-3">
		<label for="cur_id" class="col-sm-2 col-form-label">Nome</label>
		<div class="col-sm-10">

			{!! Form::text('name', null, ['id' => 'Nome', 'required' => 'required', 'class' => 'form-control']) !!}

		</div>
	</div>

	<div class="row mb-3">
		<label for="cur_id" class="col-sm-2 col-form-label">Email</label>
		<div class="col-sm-10">

			{!! Form::text('email', null, ['id' => 'Nome', 'required' => 'required', 'class' => 'form-control']) !!}

		</div>
	</div>



	<div class="row mb-3">
		<label for="payment_method" class="col-sm-2 col-form-label">Usuário</label>
		<div class="col-sm-10">
			{!! Form::text('username', null, ['id' => 'username', 'class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="password" class="col-sm-2 col-form-label">Senha</label>
		<div class="col-sm-10">
			{!! Form::password('password', array('id' => 'password', 'class' => 'form-control')) !!}
		</div>
	</div>

	<h3>Permissões</h3>
	@foreach($Roles as $id => $Role)

	<div class="form-check form-check-inline">
		@if(isset($UserRole[$Role]))
		{!! Form::checkbox('roles[]', $id, $UserRole[$Role], ['id' => $id, 'class' => 'form-check-input']) !!}
		@else
		{!! Form::checkbox('roles[]', $id, null, ['id' => $id, 'class' => 'form-check-input']) !!}
		@endif
		<label for='{{ $id }}'>{{ $Role }}</label>
	</div>


	@endforeach


</div><br />

@if(count($errors))
<div class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>
		{{$error}}
	</li>
	@endforeach
</div>
@endif
<br />


