<ul class="list-unstyled">
@forelse ($model as $order)
    <li class="media">
        <!--img src="..." class="mr-3" alt="..."-->
        <div class="media-body">
            <h5 class="mt-0 mb-1">{{$product->name}}</h5>
            <ul style="list-style: none">
                <li>Price: {{$product->price}}</li>
                <li>Brand: {{$product->brand}}</li>
            </ul>
        </div>
        <div>
            <a href="{{URL::to('products/'.$product->id.'/edit')}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <form style="display:inline-block" action="{{action('ProductController@destroy', $product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
            </form>
        </div>
    </li>
@empty
    <div class="row justify-content-center mt-5">No Orders for User</div>
@endforelse
</ul>