<div class="Group container">



	<div class="row mb-3">
		<label for="less_value" class="col-sm-2 col-form-label">Valor menor e Igual</label>
		<div class="col-sm-10">
			{!! Form::text('less_value', null, ['class' => 'form-control Money LessValue', 'id' => 'less_value',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="less_tax" class="col-sm-2 col-form-label">Taxa Menor e Igual</label>
		<div class="col-sm-10">
			{!! Form::number('less_tax', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'less_tax',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="bigger_value" class="col-sm-2 col-form-label">Valor Maior e igual</label>
		<div class="col-sm-10">
			{!! Form::text('bigger_value', null, ['class' => 'form-control Money BiggerValue', 'id' => 'bigger_value',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="bigger_tax" class="col-sm-2 col-form-label">Taxa Maior e igual</label>
		<div class="col-sm-10">
			{!! Form::number('bigger_tax', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'bigger_tax',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>


	<div class="row mb-3">
		<label for="tax_credit_card" class="col-sm-2 col-form-label">Taxa de Cartão de Crédito</label>
		<div class="col-sm-10">
			{!! Form::number('tax_credit_card', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'tax_credit_card',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="tax_bank_slip" class="col-sm-2 col-form-label">Taxa de Boleto</label>
		<div class="col-sm-10">
			{!! Form::number('tax_bank_slip', null, ['class' => 'form-control', 'step' => 'any', 'id' => 'tax_bank_slip',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>	


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


