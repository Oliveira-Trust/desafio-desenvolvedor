@props([
    'label' => '',
    'name' => '',
    'placeholder' => '',
    'required' => false,
    'autocomplete' => 'off',
])

<div>
    @if (!empty($label))
        <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <div class="flex">
        <input type="number" name="{{ $name }}" autocomplete="{{ $autocomplete }}"
            placeholder="{{ $placeholder }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
            {{ $attributes }}
            class="block w-full min-w-0 flex-1 rounded-none rounded-s-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
        <span
            class="rounded-s-0 inline-flex items-center rounded-e-md border border-s-0 border-gray-300 bg-gray-200 px-3 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-600 dark:text-gray-400">
            <span class="h-4 w-4 text-gray-500 dark:text-gray-400">
                ,00
            </span>
        </span>
    </div>
    <x-forms.error name="{{ $name }}" />
</div>
