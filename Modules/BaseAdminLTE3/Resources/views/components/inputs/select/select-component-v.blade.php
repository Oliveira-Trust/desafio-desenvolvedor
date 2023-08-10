<div {{ $attributes->merge(['class' => 'form-group']) }}>
    {!! Form::label($name, $label ?? trans("validation.attributes.$name"), ['for'=>$name,'class' => $required ? 'required' : null]) !!}
    {!! Form::select($max > 1 ? $name . '[]' : $name,$object || !$options ? [] : $options , $object ?  null: $value , ['id' => $name,'data-field'=>$field,'data-action' => $action,'data-create_load'=>$createLoad,'data-load'=>$load,'data-options' =>$object ? $options : null,'data-value' => $object ? $value : null,'data-create_url'=> $create,'data-maxitens' => $max, $disabled ? 'disabled' : null,$autofocus ? 'autofocus' : null,'class' => $inputClass,'placeholder' => $placeholder,'maxlength' => $fieldLength ? fieldLength($fieldLength) : 255]) !!}
    {!! bs4_error($name) !!}
</div>
