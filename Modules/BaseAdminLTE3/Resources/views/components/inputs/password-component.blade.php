<div {{ $attributes->merge(['class' => 'form-group']) }}>
    {!! Form::label($name, $label ?? trans("validation.attributes.$name"), ['class' => $required ? 'required' : null]) !!}
    {!! Form::password($name, [$required ? 'required': null,'class' => 'form-control'.bs4_error($name,'is-invalid'),'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255])!!}
    {!! bs4_error($name) !!}
</div>
