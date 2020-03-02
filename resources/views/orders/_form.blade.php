<input type="hidden" id="listProducts" value="{{$products->toJson()}}"/>
<input type="hidden" id="listClients" value="{{$clients->toJson()}}"/>
<script>
    $().ready(function(){
        $products = JSON.parse($('#listProducts').val());

        function findById($items, $id) {
            $return = {};
            $items.forEach(function($item){
                if ($item.id != $id) {                    
                    return;
                }
                $return = $item;
            });
            return $return;
        }

        $('.btn-add-product').click(function(){
            $dataRefer = $($(this).attr('data-refer'));
            if ($dataRefer.val() == '') {
                return false;
            }
            $('.modal').find('input').each(function(){
                $(this).val('');
            });
            
            $('.modal').find('.modal-title').html($dataRefer.find('option:selected').text());
            $('.modal').find('#product_id').val($dataRefer.val());
            $('.modal').modal();
        });

        $('.modal').find('form').submit(function(){
            $formFields = {};
            $.each($(this).serializeArray(), function (index, object) {
                $formFields[object.name] = object.value;
            });
            
            $product =findById($products, $formFields.product_id);
            
            $box = $('.order-products').find('.media:first-child').clone();
            $box.find('.product_id').attr('name', 'products['+$product.id+']').val($product.id);
            $box.find('.inpQuantity').attr('name', 'quantity['+$product.id+']').val($formFields.quantity);
            $box.find('.name').html($product.name);
            $box.find('.price').html($product.price);
            $box.find('.quantity').html($formFields.quantity);
            $box.find('.total').html($product.price*$formFields.quantity);
            $box.appendTo('.order-products').show();            
            
            $('.modal').modal('hide');
            return false;
        });

        function atualizaSelectProducts() {
            $productSelected = [];
            $('.product_id').each(function(){
                $productSelected.push($(this).val());
            });
            $('#products').find('option').show();
            $('#products').find('option').each(function(){
                if ($productSelected.indexOf($(this).attr('value')) != -1) {
                    $(this).hide();
                }
            });
            $('#products').val('');
        }

        $('.order-products').on("click", ".btn-remove-product", function() {
            $(this).parents('.media').remove();
            atualizaSelectProducts();
            return false;
        });

        $('.modal').on('hide.bs.modal', function (e) {
            atualizaSelectProducts();
        });
    });
</script>
@section('modal')
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form>
                <input type="text" name="product_id" id="product_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="products" class="col-md-4 col-form-label text-md-right">Quantity</label>
                            <div class="col-md-6">
                                <input type="number" min="1" name="quantity" id="quantity" class="form-control text-right">
                            </div>
                        </div>                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i>&nbsp;Add To Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


<div class="form-group row">
    <label for="client_id" class="col-md-4 col-form-label text-md-right">Client</label>
    <div class="col-md-6">
        <select class="custom-select mr-sm-2" id="client_id" name="client_id">
            <option value="">Choose...</option>
            @foreach ($clients->pluck('name', 'id')->toArray() as $id => $value)
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
                <option value="">Choose...</option>
                @foreach ($products->pluck('name', 'id')->toArray() as $id => $value)
                    <option value="{{$id}}">{{$value}}</option>    
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="btn btn-success btn-add-product" type="button" data-refer="#products"><i class="fas fa-plus-circle"></i></button>
            </div>
        </div>
    </div>

    <div class="col-md-12 order-products">
        
            <div class="media" style="display:none">
                <input type="hidden" class="product_id" />
                <input type="hidden" class="inpQuantity" />
                <div class="media-body">
                    <h5 class="mt-0 name">Produto 1</h5>
                </div>
                <div class="d-none d-sm-block">
                    <p>Price</p>
                    <p class="text-right price">$ 10.50</p>
                </div>
                <div>
                    <p>Quantity</p>
                    <p class="text-right quantity">{{rand(5, 10)}}</p>
                </div>                
                <div>
                    <p>Total</p>
                    <p class="text-right total">$ 10.50</p>
                </div>
                <div>
                    <button class="btn btn-danger btn-remove-product" type="button"><i class="fas fa-minus-circle"></i></button>                    
                </div>
            </div>
    </div>
</div>