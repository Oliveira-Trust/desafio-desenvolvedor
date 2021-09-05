@extends('home')
@section('card-header')
    Produtos
@endsection
@section('main')
    <form method="POST" action="{{ route('product.store') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-md-4 col-form-label text-md-right">Preço</label>
            <div class="col-md-6">

                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                       value="{{ old('price') }}" required autocomplete="price">
            </div>
        </div>
        <div class="form-group row">
            <label for="amount" class="col-md-4 col-form-label text-md-right">Quantidade</label>

            <div class="col-md-6">
                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount"
                       value="{{ old('amount') }}" required autocomplete="amount">
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Criar
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('js/inputMask.js') }}" defer></script>
@endsection


