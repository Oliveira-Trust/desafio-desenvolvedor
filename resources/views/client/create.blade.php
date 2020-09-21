@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar Cliente</div>

                    <div class="card-body">
                        <form method="post" action="{{route('clients.store')}}">
                            @include('client.form')
                            <button type="submit" class="btn btn-primary">Cadastrar cliente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


