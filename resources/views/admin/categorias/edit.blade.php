@extends('layouts.app')

@section('title') Editar Categoria @endsection

@section('content')
	<categorias-form :errors="{{ json_encode($errors->getMessages()) }}" in-edit="true" :category-data="{{ $categoria }}"></categorias-form>
@endsection