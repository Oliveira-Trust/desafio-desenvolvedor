@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar Produto</div>

                    <div class="card-body">
                        <form method="post" action="{{route('products.store')}}">
                            @include('product.form')
                            <button type="submit" class="btn btn-primary">adicionar Produto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


