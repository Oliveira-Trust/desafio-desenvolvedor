<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Conversor</title>

    <!-- Fonts -->
    @vite('resources/css/app.css')
    <!-- Styles -->
    @livewireStyles
</head>
<body class="bg-background">
<div class="min-h-screen h-full w-screen">
    <div class="w-full flex justify-center py-4">
        <span class="text-3xl text-base-red mx-auto">Logo</span>
    </div>

    <livewire:currency-converter/>
</div>

@vite('resources/css/js.css')
@livewireScripts
</body>
</html>
