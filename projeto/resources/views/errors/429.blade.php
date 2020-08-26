@extends('errors::minimal')

@section('title', __('Muitos requests'))
@section('code', '429')
@section('message', __('Muitos requests. Tente novamente mais tarde.'))
