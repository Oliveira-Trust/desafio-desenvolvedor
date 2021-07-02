@extends('layouts.app')

@section('title') Clientes @endsection

@section('content')
	<clientes-index :clientes="{{ $clientes }}"></clientes-index>
@endsection