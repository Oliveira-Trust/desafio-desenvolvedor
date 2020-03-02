<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
    <div class="col-md-6">
        <input type="text" name="name" id="name" value="{{$model->name}}" class="form-control">
    </div>    
</div>
<div class="form-group row">
    <label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>
    <div class="col-md-6">
        <input type="text" name="brand" id="brand" value="{{$model->name}}" class="form-control">
    </div>    
</div>
<div class="form-group row">
    <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="number" min="0.01" step="any" class="form-control text-right" value="{{$model->price}}" name="price" id="price" >
        </div>        
    </div>    
</div>