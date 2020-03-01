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
            </td>
        </tr>        
    @endforeach
    </table>
</div>

{{ $clients->links() }}