@props([
    'type' => 'text',
    'label' => '',
    'id' => '',
    'name' => '',
    'placeholder' => '',
    'required' => false,
    'autocomplete' => 'off',
    'helperText' => '',
    'errorBag' => null,
])

<div>
    @if (!empty($label))
        <label for="{{ $id }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <input
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500']) }}
        type="{{ $type }}" name="{{ $name }}" autocomplete="{{ $autocomplete }}"
        placeholder="{{ $placeholder }}" id="{{ $id }}" {{ $required ? 'required' : '' }} />
    <x-forms.error :name="$name" :errorBag="$errorBag" />
    @if (!empty($helperText))
        <p id="helper-text-explanation-{{ $name }}" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif
</div>
