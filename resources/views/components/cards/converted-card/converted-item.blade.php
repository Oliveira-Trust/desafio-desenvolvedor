@props([
    'label' => '',
])

<div class="border-b border-gray-200 py-4 dark:border-gray-700">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ $label }}
                </div>
            </div>
        </div>
        <div class="ml-4">
            <div class="text-sm font-medium text-gray-900 dark:text-white">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
