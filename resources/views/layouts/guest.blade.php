<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Acceso - CT Olof Palme</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#EBE9E1]">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div>
                <a href="/">
                    <img src="{{ asset('img/logo-ct.png') }}" alt="Logo CT Olof Palme" class="h-28 w-auto object-contain drop-shadow-md">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-t-8 border-[#8cc63f]">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} INATEC. Centro Tecnológico Olof Palme, Estelí.
            </div>
        </div>
        <x-notificaciones />
    </body>
</html>