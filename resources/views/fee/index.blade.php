@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Taxas cadastradas no sistema</div>

                @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Erro</h4>
                    @foreach ($errors->all() as $error)
                        <li class="mb-0">
                            {{ $error }}
                        </li>
                    @endforeach
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th style="cursor:pointer">TIPO</th>
                                    <th style="cursor:pointer">MÉTODO DE PAGAMENTO</th>
                                    <th style="cursor:pointer">TAXA</th>
                                    <th style="cursor:pointer">MÍNIMO DE COMPRA PARA DESCONTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                    <tr>
                                        <td>
                                            <a href="{{ route('fee.edit', $fee->id )}}" style="color:black; text-decoration:none;cursor:pointer">
                                                {{ $fee->label }}
                                            </a>
                                        </td>
                                        <td>{{ $fee->payment_method ? $fee->payment_method : '-//-' }}</td>
                                        <td>
                                            {{ $fee->fee }}%
                                        </td>
                                        <td>
                                            {{ $fee->depends_on ? 'BRL ' . number_format($fee->depends_on, 2,".",",") : '-//-'}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <a href="{{route('price.create')}}">
                        <button type="button" class="btn btn-info mr-1 mb-1">Fazer cotação</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
