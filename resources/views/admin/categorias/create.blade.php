@extends('layouts.app')

@section('title') Adicionar Categoria @endsection

@section('content')
	<categorias-form :errors="{{ json_encode($errors->getMessages()) }}"></categorias-form>
@endsection