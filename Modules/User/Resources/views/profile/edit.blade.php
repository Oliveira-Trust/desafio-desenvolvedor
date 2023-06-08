@extends('layouts.common.main')

@section('title', 'Perfil do Usuário')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Perfil do Usuário</h1>

        @include('user::profile.partials.update-profile-information-form')
        @include('user::profile.partials.update-password-form')

    </div>
@endsection
