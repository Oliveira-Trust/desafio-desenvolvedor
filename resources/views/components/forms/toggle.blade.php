@props([
    'id' => '',
    'name' => '',
    'required' => false,
    'helperText' => '',
    'errorBag' => null,
    'checked' => false,
])

<div class="flex items-center">
    <label x-data="{ checked: @js($checked) }" class="inline-flex cursor-pointer items-center">
        <input type="checkbox" name="{{ $name }}" {{ $required ? 'required' : '' }} value="1"
            class="peer sr-only" @checked($checked) x-on:click="checked = !checked">
        <div
            class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800">
        </div>
        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
            x-text="checked ? 'Desativar' : 'Ativar'"></span>
    </label>
    <x-forms.error :name="$name" :errorBag="$errorBag" />
    @if (!empty($helperText))
        <p id="helper-text-explanation-{{ $name }}" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            {{ $helperText }}
        </p>
    @endif
</div>
