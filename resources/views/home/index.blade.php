@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Home')

@section('pagina_conteudo')

<div class="container">
	<div class="row center-align" style="margin-top: 30px;">
		<form action="{{ url('/busca') }}" method="POST">
			{{ csrf_field() }}
			<div class="col s12 m8 l10">
				<input type="text" name="pesquisar" placeholder="Pesquisar...">
			</div>
			<div class="col s12 m4 l2">
				<button type="submit" class="btn btn-large red" title="Pesquisar">Pesquisar</button>
			</div>
		</form>
	</div>

	<div class="row">
	@foreach($registros as $registro)
		<div class="col s12 m6 l4">
			<div class="card">
				<div class="card-content">
					<span class="card-title grey-text text-darken-4 truncate" title="{{ $registro->nome }}">{{ $registro->nome }}</span>
					<p>R$ {{ number_format($registro->valor, 2, ',', '.') }}</p>
				</div>
				<div class="card-action">
					<a class="red-text" href="{{ route('produto', $registro->id) }}">Ver Mais</a>
				</div>
			</div>
		</div>
	@endforeach
	</div>
</div>

@endsection