@extends('home')
@section('card-header')
    Usuários
@endsection
@section('main')
    <form method="POST" action="{{route('password.change',\Illuminate\Support\Facades\Auth::id())}}">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="password_old" class="col-md-4 col-form-label text-md-right">Senha Atual</label>

            <div class="col-md-6">
                <input id="password_old" type="password" class="form-control @error('password_old') is-invalid @enderror" name="password_old" required >

                @error('password_old')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Nova {{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Editar
                </button>
            </div>
        </div>
    </form>
@endsection
