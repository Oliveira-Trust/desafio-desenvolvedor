<div {{ $attributes->merge(['class' => 'form-group row']) }}>
    {!! Form::label($name, $label ?? trans("validation.attributes.$name"), ['for'=>$name,'class' => $labelClass]) !!}
    {{--<label for="_{{ $name }}" class="col-sm-2 col-form-label">Email</label>--}}
    <div class="{{ $divClass }}">
        @if($prepend)
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="validatedInputGroupPrepend">{{ $prepend }}</span>
                </div>
                @if ($type === 'password')
                    {!! Form::$type($name, ['id' => $name,'data-field' => $field,'data-action' => $action,'rows'=> $rows ?? null,'data-autoresize' => $autoresize ? '':null/*,$required ? 'required': null*/,$disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
                @else
                    {!! Form::$type($name, $value, ['id' => $name,'data-field' => $field,'data-action' => $action,'rows'=> $rows ?? null,'data-autoresize' => $autoresize ? '':null/*,$required ? 'required': null*/,$disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
                @endif
            </div>
        @else
            @if ($type === 'password')
                {!! Form::$type($name, ['id' => $name,'data-field' => $field,'data-action' => $action,'rows'=> $rows ?? null,'data-autoresize' => $autoresize ? '':null/*,$required ? 'required': null*/,$disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
            @else
                {!! Form::$type($name, $value, ['id' => $name,'data-field' => $field,'data-action' => $action,'rows'=> $rows ?? null,'data-autoresize' => $autoresize ? '':null/*,$required ? 'required': null*/,$disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
            @endif
        @endif

        @if (isset($help))
            <small class="form-text text-orange">
                {{ $help }}
            </small>
        @endif

        {!! bs4_error($name) !!}
        @if ($dataFieldExtra)
            <div data-field="{{ $dataFieldExtra }}"></div>
        @endif
    </div>
    @if (isset($help_right))
        <div class="col-12 offset-0 col-sm-12 offset-sm-4 col-md offset-md-0 align-self-center line-1">
            <small class="text-orange">
                {{ $help_right }}
            </small>
        </div>
        {{-- <div class="col-auto align-self-center">
             <small class="text-orange">
                 {{ $help_right }}
             </small>
         </div>--}}
    @endif
    {{ $slot }}
</div>
