@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Histórico de Cotações</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Moeda Origem</th>
                                <th scope="col">Moeda Destino</th>
                                <th scope="col">Valor para conversão</th>
                                <th scope="col">Data Criação</th>
                                <th scope="col">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($history as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->currency_origin}}</td>
                                    <td>{{$value->currency_buy}}</td>
                                    <td>@money($value->amount)</td>
                                    <td>{{$value->createdAt()}}</td>
                                    <td>
                                        <a href="{{route('history-show', $value->id)}}" class="btn btn-sm btn-dark"
                                           type="button">Detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {!! $history->links() !!}
                        </div>

                        <hr>
                        <a href="{{route('home')}}" class="btn btn-warning" type="button">Voltar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
