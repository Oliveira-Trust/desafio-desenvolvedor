@extends('layouts.app')

@section('content')
<div class="container">

            <div class="card">
                <div class="card-header">Client

                    <a href={{ URL::previous() }}>
                        <button class="btn btn-danger float-right">
                            <i class="fas fa-window-close"></i>
                            {{ __('Back') }}
                        </button>
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($show ?? false)
                    <fieldset disabled="disabled">
                        @else
                        <fieldset>
                            @endif

                            @if (isset($model->id))
                                <form id="principal" action="{{'/'.explode('/', Route::current()->uri)[0].'/'.$model->id}}"
                                method="post">
                                @method('PUT')
                            @else
                                <form id="principal" action="{{route('client.store')}}" method="post">
                            @endif
                                    <div class="form-group">





                                        @csrf
                                        <label for="name" class="">Nome de quem vai receber</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if ($model->name) {{$model->name}} @endif{{old('name')}}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br />
                                        <label for="phone" class="">Telefone</label>
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="@if ($model->phone) {{$model->phone}} @endif{{old('phone')}}" required autocomplete="phone" autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br />
                                        <label for="address" class="">Endereço completo com referencia</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="@if ($model->address) {{$model->address}} @endif{{old('address')}}" required autocomplete="address" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @if ($show ?? false)
                                    @else
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        {{ __('Save') }}
                                    </button>
                                    @endif

                                </form>
                        </fieldset>
                </div>
            </div>
        </div>

@endsection
