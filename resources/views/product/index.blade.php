@extends('home')
@section('card-header')
    Produtos
@endsection
@section('main')
    <div class="col-sm-12 text-right">
    <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{route('product.destroy')}}">Excluir todos Selecionados</button>
    <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('product.create')}}">Criar</a>
    </div>
    <table class="table table-bordered" id="table-product">
        <thead>
        <tr>
            <th width="50px"><input type="checkbox" id="master"></th>
            <th width="80px">#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th width="100px">Ação</th>
        </tr>
        </thead>
        @if($products->count())
            <tbody>

            @foreach($products as $key => $product)
                <tr id="tr_{{$product->id}}">
                    <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R${{ $product->price }}</td>
                    <td>{{ $product->inventory->amount }}</td>
                    <td>
                        <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm"> Atualizar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection

@section('js')
    <script src="{{ asset('js/deleteJs.js') }}" defer></script>
    <script src="{{ asset('js/table-product.js') }}" defer></script>

@endsection
