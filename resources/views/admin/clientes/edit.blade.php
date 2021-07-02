@extends('layouts.app')

@section('title') Editar Cliente @endsection

@section('content')
	<clientes-form :errors="{{ json_encode($errors->getMessages()) }}" in-edit="true" :client-data="{{ $cliente }}"></clientes-form>
@endsection