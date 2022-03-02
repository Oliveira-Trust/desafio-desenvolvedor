@extends('layouts.app')

@section('content')

@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Alerta!</h5>
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Valor</th>
                <th scope="col">Tipo</th>
                <th scope="col">Taxa</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($conversaoTaxas as $taxa)
            <tr>
                <td>{{$taxa['valor']}}</td>
                <td>{{$taxa['tipo']}}</td>
                <td>{{$taxa['taxa']}}</td>
                <td>
                    <a class="btn btn-primary btn-xs" href="{{route('conversao-taxa.edit', $taxa->id)}}"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection