@extends('home')
@section('card-header')
    Produtos
@endsection
@section('main')
    <div class="col-sm-12">
        <a href="{{route('purchase.index')}}" data-url="{{route('purchase.index')}}" class="btn btn-dark my-3 back-button">Voltar</a>
        <p style="margin-bottom: 10px" class="">Valor Total: </p><p class="totalValue">0,00</p>
        <div>
            <div class="col-sm-12 text-right">
                <button style="margin-bottom: 10px" id="edit-compra" class="btn btn-success "
                        data-url="{{route('purchase.update',$purchase->id)}}">Finalizar edição
                </button>
            </div>

            <table class="table table-bordered" id="edit-purchase">
                <thead>
                <tr>
                    <th width="50px">Selecione</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                </tr>
                </thead>
                @if($products->count() && $purchase)
                    <tbody>

                    @foreach($products as $key => $product)
                        <tr id="tr_{{$product->id}}" class="lines">
                            <td width="50px">
                                <input type="checkbox"
                                       name="check"
                                       class="sub_chk"
                                       data-id="{{$product->id}}"
                                    {{$purchase->products->contains($product) ? 'checked': ''}}
                                >
                            </td>
                            <td>{{ $product->name }}</td>
                            <td class="value-id-{{$product->id}}">{{ $product->price }}</td>
                            <td>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input  type="number" max="{{$product->inventory->amount}}" min="0" class="form-control @error('amount') is-invalid @enderror amount-{{$product->id}}"  name="amount"
                                                value="{{$purchase->products->contains($product) ? $purchase->products->filter(function  ($prod) use ($product) { return $prod->id == $product->id; })->first()->pivot->amount : 0 }}" required autocomplete="amount">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

            @endsection
@section('js')
                <script src="{{ asset('js/purchase-edit.js') }}" defer></script>
@endsection


