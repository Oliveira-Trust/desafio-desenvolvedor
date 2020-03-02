<div class="form-group row">
    <label for="client_id" class="col-md-4 col-form-label text-md-right">Client</label>
    <div class="col-md-6">
        <select class="custom-select mr-sm-2" id="client_id">
            <option value="">Choose...</option>
            @foreach (['teste', 'heric'] as $id => $value)
                <option value="{{$id}}">{{$value}}</option>    
            @endforeach
          </select>       
    </div>    
</div>

<div class="form-group row">
    <label for="products" class="col-md-4 col-form-label text-md-right">Products</label>
    <div class="col-md-6">
        <div class="input-group">
            <select class="custom-select" id="products" aria-label="Example select with button addon">
                @foreach (['teste', 'heric'] as $id => $value)
                    <option value="{{$id}}">{{$value}}</option>    
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="btn btn-success" type="button"><i class="fas fa-plus-circle"></i></button>
            </div>
        </div>
    </div>

    <div class="col-md-12 order-products">
        @foreach (['Produto1', 'Produto 2'] as $orderProduct)
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0">Produto 1</h5>
                    
                </div>
                <div class="d-none d-sm-block">
                    <p>Price</p>
                    <p class="text-right">$ 10.50</p>
                </div>
                <div>
                    <p>Quantity</p>
                <p class="text-right">{{rand(5, 10)}}</p>
                </div>
                <div class="d-none d-sm-block">
                    <p>Discount</p>
                    <p class="text-right">10%</p>
                </div>
                <div>
                    <p>Total</p>
                    <p class="text-right">$ 10.50</p>
                </div>
                <div>
                    <button class="btn btn-danger" type="button"><i class="fas fa-minus-circle"></i></button>                    
                </div>
            </div>    
        @endforeach        
    </div>
</div>