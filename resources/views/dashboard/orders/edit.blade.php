@extends('layouts.dashboard.admin')
@section('title', 'Alterar Pedido')

@section('content')
 <main>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Pedido</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('orders.index')}}" class="btn btn-primary btn-sm">Voltar</a>
        </div>
    </div>
    <div class="card">

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('orders.update', $order) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                    <div class="col-md-6">
                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                            <option value="Em aberto" {{ ($order->status === 'Em aberto') ? 'selected' : ''  }}>Em aberto</option>
                            <option value="Cancelado"{{ ($order->status === 'Cancelado') ? 'selected' : '' }} >Cancelado</option>
                            <option value="Pago" {{ ($order->status === 'Pago') ? 'selected' : ''  }}>Pago</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Salvar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


</main>
@endsection

