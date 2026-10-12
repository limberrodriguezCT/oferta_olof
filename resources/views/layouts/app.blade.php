<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CT Olof Palme') }} | Panel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <!-- Se aplicó el fondo de cuadrícula CSS al body -->
    <body class="font-sans antialiased" 
          style="
            background-color: #EBE9E1;
            background-image: 
              linear-gradient(to right, rgba(0, 56, 118, 0.05) 1px, transparent 1px),
              linear-gradient(to bottom, rgba(0, 56, 118, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
          ">
        
        <div class="min-h-screen flex flex-col">
            
            <!-- Su menú de navegación original -->
            @include('layouts.navigation')

            <!-- Contenedor principal donde se inyectan las demás vistas -->
            <main class="py-8 flex-grow">
                {{ $slot }}
            </main>
        </div>
        
        <x-notificaciones />
    </body>
</html>