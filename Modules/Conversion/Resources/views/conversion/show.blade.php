@extends('user::layouts.default')

@section('content')
    <div class="rbox">
        <x-conversion :conversion="$conversion"/>
    </div>
    <div class="rbox p-2">
        <a href="{{ route('conversion::conversion.index') }}" class="btn btn-default disable-link"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
@endsection
