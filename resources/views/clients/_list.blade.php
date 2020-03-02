@foreach ($model as $client)
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