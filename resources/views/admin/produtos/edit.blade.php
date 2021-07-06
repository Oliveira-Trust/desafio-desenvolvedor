@extends('layouts.app')

@section('title') Editar Produto @endsection

@section('content')
	<produtos-form :errors="{{ json_encode($errors->getMessages()) }}" in-edit="true" :product-data="{{ $produto }}" :categories="{{ $categories }}"></produtos-form>
@endsection