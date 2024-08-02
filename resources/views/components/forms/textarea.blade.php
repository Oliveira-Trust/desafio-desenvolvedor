@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'rows' => 4,
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
    <textarea id="description" name="description" rows="{{ $rows }}" autocomplete="{{ $autocomplete }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} id="{{ $id }}"
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">{{ $value }}</textarea>
    <x-forms.error :name="$name" :errorBag="$errorBag" />
    @if (!empty($helperText))
        <p id="helper-text-explanation-{{ $name }}" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif
</div>
