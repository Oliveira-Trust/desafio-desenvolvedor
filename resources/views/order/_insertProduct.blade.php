<div class="card">
        <div class="card-header">{{ __('Inserir Produtos') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('order.addProduct', ['order' => $order->id]) }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Produto') }}</label>

                    <div class="col-md-6">
                        {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus> --}}
                        <select id="productSelect" name="product" class="form-control">
                            @foreach ($products as $item)
                        <option value={{$item->id}}>{{$item->name}} R$ {{number_format($item->price,2)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantidade"
                        class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                    <div class="col-md-6">
                        <input id="quantidade" type="number"
                            class="form-control @error('quantidade') is-invalid @enderror" name="quantidade"
                            value="{{ old('quantidade') }}" required autocomplete="quantidade">

                        @error('quantidade')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Inserir Produto ao pedido') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
