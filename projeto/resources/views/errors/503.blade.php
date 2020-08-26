@extends('errors::minimal')

@section('title', __('Serviço indisponível'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Serviço indisponível'))
