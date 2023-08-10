<div {{ $attributes->merge(['class' => 'form-group row']) }}>
    <div class="{{ $divClass }}">
        <div class="checkbox-custom">
            {!! Form::checkbox($name, 1, $value ,['id'=>$name,'data-field' => $field,'class' => $inputClass,$disabled ? 'disabled' : null]) !!}
            <label for="{{ $name }}">{{ $label }}</label>
        </div>
        {!! bs4_error($name) !!}
        {{--<div data-field="disable"></div>--}}
    </div>
</div>
