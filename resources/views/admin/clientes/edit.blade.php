@extends('layouts.app')

@section('title') Editar Cliente @endsection

@section('content')
	<clientes-form :errors="{{ json_encode($errors->getMessages()) }}" in-edit="true" :client-data="{{ $cliente }}" :cities="{{ $cities }}"></clientes-form>
@endsection