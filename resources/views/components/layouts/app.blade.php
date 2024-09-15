<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title ?? 'Login Register' }}</title>
    @vite('resources/css/app.css')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @livewireStyles

</head>

<body>
    <livewire:navbar />
    <div class="container mx-auto">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
