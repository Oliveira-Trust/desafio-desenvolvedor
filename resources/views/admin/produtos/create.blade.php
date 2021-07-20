@extends('layouts.app')

@section('title') Adicionar Produto @endsection

@section('content')
	<produtos-form :categories="{{ $categories }}" :errors="{{ json_encode($errors->getMessages()) }}"></produtos-form>
@endsection