@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">Product
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
                        <form id="principal" action="{{route('product.store')}}" method="post">
                            @endif
                            <div class="form-group">
                                @csrf
                                <label for="name" class="">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if ($model->name) {{$model->name}} @endif{{old('name')}}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                <br />
                                <label for="ean" class="">Ean</label>
                                <input id="ean" type="text" class="form-control @error('ean') is-invalid @enderror" name="ean" value="@if ($model->ean) {{$model->ean}} @endif{{old('ean')}}" required autocomplete="ean" autofocus>
                                        @error('ean')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                <br />
                                <label for="price" class="">Price</label>
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="@if ($model->price) {{$model->price}} @endif{{old('price')}}" required autocomplete="price" autofocus>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                {{ __('Save') }}
                            </button>
                </fieldset>

                </form>

        </div>
    </div>
</div>

@endsection
