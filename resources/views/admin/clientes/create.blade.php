@extends('layouts.app')

@section('title') Adicionar Cliente @endsection

@section('content')
	<clientes-form :errors="{{ json_encode($errors->getMessages()) }}" :cities="{{ $cities }}"></clientes-form>
@endsection