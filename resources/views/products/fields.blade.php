<div class="row">
    <div class="col-md-6 col-sm-12">
        @if (empty($product))
        {!! Form::hidden('user_id', \Auth::user()->id) !!}
        @else
        {!! Form::hidden('user_id', $product->user_id) !!}
        @endif

        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', __("product.columns.name") . ':') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Description Field -->
        <div class="form-group">
            {!! Form::label('description', __("product.columns.description") . ':') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        
        <!-- Status Id Field -->
        <div class="form-group">
            {!! Form::label('status_id', __("product.columns.status_id") . ':') !!}
            {!! Form::select('status_id', $statuses, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- Price Field -->
        <div class="form-group">
            {!! Form::label('price', __("product.columns.price") . ':') !!}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ __("Currency Symbol") }}</span>
                </div>
                {!! Form::text('price', null, ['class' => 'form-control', 'min' => 0]) !!}
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
            $('#price').mask("#.##0,00", {
                reverse: true
            });
            </script>
        @endpush
        <!-- Image Field -->
        <div class="form-group">
            @php $urlImage = (empty($product) ? null : str_replace(url('/').'/', '', $product->image)); @endphp
            {!! Form::label('image', __("product.columns.image") . ':') !!}
            {!! Form::select('image', $images, $urlImage, ['class' => 'form-control']) !!}
            
            <img id="img-show" src="{{ (empty($product) ? url('/') . '/' . array_key_first($images) : $product->image) }}" class="img-thumbnail" />
        </div>
        @push('scripts')
            <script type="text/javascript">
            $('#image').on("change", function () {
                let url = '{{ url('/')}}';
                $('#img-show').attr('src', url + '/' + $('#image').val());
            });
            </script>
        @endpush
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__("Save"), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('products.index') }}" class="btn btn-secondary">{{ __("Cancel")}}</a>
    </div>
</div>
