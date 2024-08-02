@props(['name', 'errorBag' => null])

@error($name, $errorBag)
    <div class="mt-2 text-sm text-red-600 dark:text-red-500">
        {{ $message }}
    </div>
@enderror
