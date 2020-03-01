<div class="container">
    <table>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
    @foreach ($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>
                <a href="{{ URL::to('clients/' . $client->id . '/edit') }}">Edit</a>
                <form style="display:inline-block" action="{{action('ClientController@destroy', $client['id'])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                </form> 
            </td>
        </tr>        
    @endforeach
    </table>
</div>

{{ $clients->links() }}