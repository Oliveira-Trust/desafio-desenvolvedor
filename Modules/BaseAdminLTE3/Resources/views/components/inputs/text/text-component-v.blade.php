<div {{ $attributes->merge(['class' => 'form-group']) }}>
    {!! Form::label($name, $label ?? trans("validation.attributes.$name"), ['for'=>$name,'class' => $required ? 'required' : null]) !!}
    {!! Form::$type($name, $value, ['rows'=> $rows ?? null,'data-autoresize' => $autoresize ? '':null,$required ? 'required': null,$disabled ? 'disabled' : null, $autofocus ? 'autofocus' : null,'id' => $name,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
    {!! bs4_error($name) !!}
</div>
