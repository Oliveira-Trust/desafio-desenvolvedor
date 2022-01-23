<div class="Group container">

	<div class="row mb-3">
		<label for="cur_id" class="col-sm-2 col-form-label">Moeda Destino</label>
		<div class="col-sm-10">
			{!! Form::select('cur_id', $CurrencyList, null, ['class' => 'form-control', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="origin_value" class="col-sm-2 col-form-label">Valor  </label>
		<div class="col-sm-10">
			{!! Form::text('origin_value', null, ['class' => 'form-control Money', 'id' => 'origin_value',  'placeholder' => 'Valor', 'required' => 'required']) !!}
		</div>
	</div>

	<div class="row mb-3">
		<label for="payment_method" class="col-sm-2 col-form-label">Meio  de Pagamento</label>
		<div class="col-sm-10">
			{!! Form::select('payment_method', $PaymentMethodList, null, ['class' => 'form-control', 'required' => 'required']) !!}
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


