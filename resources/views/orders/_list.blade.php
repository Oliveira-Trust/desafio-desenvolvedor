<ul class="list-unstyled">
@forelse ($model as $order)
    <li class="media">
        <!--img src="..." class="mr-3" alt="..."-->
        <div class="media-body">
            <h5 class="mt-0 mb-1">{{$order->id}}</h5>
            <ul style="list-style: none">
                <li>Client: {{$order->client->name}}</li>
                <li>Price: {{$order->price}}</li>
            </ul>
        </div>
        
        <div>
            <a href="{{URL::to('orders/'.$order->id.'/edit')}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
            <a href="{{URL::to('orders/'.$order->id.'/edit')}}" class="btn btn-warning"><i class="fas fa-cart-plus"></i></a>
            <a href="{{URL::to('orders/'.$order->id.'/edit')}}" class="btn btn-danger"><i class="fas fa-ban"></i></a>
        </div>
    </li>
@empty
    <div class="row justify-content-center mt-5">No Orders for User</div>
@endforelse
</ul>