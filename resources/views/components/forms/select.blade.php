@props([
    'label' => '',
    'name' => '',
    'default' => '',
    'options' => [],
    'readonly' => false,
    'disabled' => false,
    'required' => false,
])

<div>
    @if (!empty($label))
        <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <select id="{{ $name }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
        @if (!empty($default))
            <option selected value="{{ $default }}">{{ $default }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <x-forms.error name="{{ $name }}" />
</div>
