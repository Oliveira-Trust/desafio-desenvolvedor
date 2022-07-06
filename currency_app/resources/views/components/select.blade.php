@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none']) !!}>
    @foreach($options as $key => $value)
        <option key='{{ $key }}' value='{{ $key }}' {{ ($key == old($attributes['name'])) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
