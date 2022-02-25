@extends('app')
@section('content')
<div class="text-center mt-5 col-5" style="margin: auto">
    @if($errors->any())
        <div class="alert alert-danger">
            {{ implode(' ', $errors->all(':message')) }}
        </div>
    @endif
    <form accept="{{route('login')}}" method="POST" class="mt-5">
        @csrf
    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{old('email')}}" name="email" autofocus>
        <label for="floatingInput">{{__('Email')}}</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">{{__('Password')}}</label>
    </div>

    <div class="checkbox mb-3">
      <label>
          <input type="checkbox" value="remember-me"> {{ __('Remember me') }}
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit"> {{ __('Log in') }}</button>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
    @endif
  </form>
</div>
@endsection
