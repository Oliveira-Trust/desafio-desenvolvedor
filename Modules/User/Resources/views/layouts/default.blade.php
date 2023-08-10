@extends('baseadminlte3::layouts.default')

@push('css')
    @include('user::layouts.default.css')
@endpush

@prepend('js')
    @include('user::layouts.default.js')
@endprepend

@section('page_header')
    @include('user::layouts.default.page_header')
@endsection

@section('header')
    @include('user::layouts.default.header')
@endsection

@section('main-sidebar')
    @include('user::layouts.default.main-sidebar')
@endsection

@section('footer')
    @include('user::layouts.default.footer')
@endsection
