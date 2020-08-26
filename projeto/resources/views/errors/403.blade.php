@extends('errors::minimal')

@section('title', __('Acesso negado'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Acesso negado'))
