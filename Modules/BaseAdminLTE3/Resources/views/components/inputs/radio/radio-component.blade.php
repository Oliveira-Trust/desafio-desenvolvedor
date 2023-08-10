<div {{ $attributes->merge(['class' => 'form-group']) }}> {{--col-auto--}}
    <div class="radio-custom radio-primary radio-inline">
        {!! Form::radio($name, 0, true,  ['id' => 'description_custom1','data-url'=>route('contact::contact.field',0),'class'=>$inputClass]) !!}
        <label for="description_custom1" class="font-weight-normal">{{ $label }}</label>
        {!! bs4_error($name) !!}
    </div>
</div>
