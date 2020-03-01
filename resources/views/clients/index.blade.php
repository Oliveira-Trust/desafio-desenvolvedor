@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clients</h1>
        <a href="{{URL::to('clients/create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Clients</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                @foreach ($clients as $client)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$client->name}}</h5>
                            <!--p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p-->
                            <a href="{{URL::to('clients/'.$client->id.'/edit')}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <form style="display:inline-block" action="{{action('ClientController@destroy', $client['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ $clients->links() }}

@endsection