@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Cliente {{$client->name}}</div>

                    <div class="card-body">
                        <form method="post" action="{{route('clients.update', ["client" => $client])}}">
                            @csrf
                            @method('PATCH')
                            @include('client.form')
                            <button type="submit" class="btn btn-primary">Editar cliente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


