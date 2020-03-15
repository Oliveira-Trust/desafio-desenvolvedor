@extends('layouts.template')

@section('title', 'Produtos')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <h2>Meus Produtos</h2>
        <hr>
        <a href="{{route('product.create')}}" class="btn btn-md btn-success mb-2">Novo Produto</a>

        <form class="row mt-2" method="get">

            <div class="col-md-2 col-form-label font-weight-bold mb-2">Título:</div>
            <div class="col-md-10 mb-2"><input type="search" class="form-control" name="title" id="title" value="{{ $filters['title'] ? $filters['title'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Valor Inicial:</div>
            <div class="col-md-2"><input type="text" class="form-control" name="price_initial" id="price_initial" value="{{ $filters['price_initial'] ? $filters['price_initial'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Valor Final:</div>
            <div class="col-md-2"><input type="text" class="form-control" name="price_end" id="price_end" value="{{ $filters['price_end'] ? $filters['price_end'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Ordernar por:</div>
            <div class="col-md-2">
                <select name="order" id="order" class="form-control">
                    <option {{ $filters['order'] == 'created_at' ? 'selected' : '' }} value="created_at">Data</option>
                    <option {{ $filters['order'] == 'id' ? 'selected' : '' }} value="id">ID</option>
                    <option {{ $filters['order'] == 'title' ? 'selected' : '' }} value="title">Title</option>
                    <option {{ $filters['order'] == 'price' ? 'selected' : '' }} value="price">Preço</option>
                </select>
            </div>

            <div class="col-md-8 mt-4"></div>
            <div class="col-md-4 mt-4">
                <button class="btn btn-md btn-info btn-block text-light">Filtrar</button>
            </div>
        </form>

        @if($products->count() > 0)
            <table class="table table-stripped table-hover mt-3">
                <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center" width="80"></th>
                    <th class="text-center">TÍTULO</th>
                    <th class="text-center">PREÇO</th>
                    <th class="text-center">Publicado</th>
                    <th width="160" class="text-center">AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $product->photos()->first() ? asset('storage/products/' . $product->photos()->first()->image ) : asset('images/no-photo.jpg')  }}" alt="[ FOTO DO PRODUTO ]" class="img-fluid">
                            </td>
                            <td class="text-center">{{$product->title}}</td>
                            <td class="text-center">R$ {{number_format($product->price, 2, ',', '.')}}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($product->created_at))  }}</td>
                            <td class="text-center">
                            <span class="btn-group">
                                <a href="{{route('product.show', $product->id)}}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-warning ml-1">Editar</a>
                                <form action="{{route('product.destroy', $product->id)}}" method="post" class="form-inline" id="form-del-{{$product->id}}">
                                    @csrf
                                        @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="confirmDelete(this, event, 'form-del-{{$product->id}}')">Excluir</button>
                                </form>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Nenhum produto cadastrado!!!
            </div>
        @endif

    </div>

@endsection

@section('scripts')
<script>
    function confirmDelete(t, e, id) {
        e.preventDefault();

        $('.modal-header, .close').addClass('bg-danger').addClass('text-light');
        $('#title-modal').html('Deseja Realmente excluir esse anúncio?');

        $('.modal-body').html('Apagando esse anúncio todos dados relacionados a ele irá ser apagado também!');

        $('#cancel').removeClass('btn-secondary').addClass('btn-default');
        $('#save').removeClass('btn-primary').addClass('btn-danger').data('id', id).html('Apagar');

        $('.modal').modal('show');
    }

    $(document).on('click', '#save', function () {
        let id = $(this).data('id');
        document.getElementById(id).submit();
        $('.modal').modal('hide');
    });

    $(function () {

        $('#price_initial').maskMoney({thousands: '.', decimal: ','});
        $('#price_end').maskMoney({thousands: '.', decimal: ','});

    });
</script>
@endsection
