<ul class="list-unstyled">
@forelse ($model as $client)
    <li class="media">
        <!--img src="..." class="mr-3" alt="..."-->
        <div class="media-body">
            <h5 class="mt-0 mb-1">{{$client->name}}</h5>            
        </div>
        <div>
            <a href="{{URL::to('clients/'.$client->id.'/edit')}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <form style="display:inline-block" action="{{action('ClientController@destroy', $client->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
            </form>
        </div>
    </li>
@empty
    <div class="row justify-content-center mt-5">No Clients for User</div>
@endforelse
</ul>