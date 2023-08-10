<div {{ $attributes->merge(['class' => 'form-group row']) }}>
    {!! Form::label($name, $label ?? trans("validation.attributes.$name"), ['for'=>$name,'class' => $labelClass]) !!}
    <div class="{{ $divClass }}">
        {!! Form::select($max > 1 ? $name . '[]' : $name,$object || !$options ? [] : $options , $object ?  null: $value , ['id' => $name,'data-field'=>$field,'data-action' => $action,'data-create_load'=>$createLoad,'data-load'=>$load,'data-options' =>$object ? $options : null,'data-value' => $object ? $value : null,'data-create_url'=> $create,'data-maxitens' => $max, $disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255]) !!}
        {{--{!! bs4_error($name) !!}--}}
        {{--<div data-field="{{ $name }}"></div>
        <div data-field="{{ $name.'*' }}"></div>--}}
        {{--<div data-field="contact_group_id"></div>--}}
        @if (isset($help))
            <small class="{{--form-text --}}text-orange">
                {{ $help }}
            </small>
        @endif
    </div>
    @if (isset($help_right))
        <div class="col-12 offset-0 col-sm-12 offset-sm-4 col-md offset-md-0 align-self-center line-1">
            <small class="text-orange">
                {{ $help_right }}
            </small>
        </div>
    @endif
    {{ $slot }}
</div>
