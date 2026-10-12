<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Administrativo | CT Olof Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800 font-sans min-h-screen flex flex-col justify-center items-center" 
      style="
        background-color: #EBE9E1;
        background-image: 
          linear-gradient(to right, rgba(0, 56, 118, 0.05) 1px, transparent 1px),
          linear-gradient(to bottom, rgba(0, 56, 118, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
      ">
    
    <div class="mb-8">
        <a href="{{ route('inicio') ?? url('/') }}">
            <div class="bg-white p-4 rounded-3xl shadow-md border-b-4 border-[#8cc63f]">
                <img src="{{ asset('img/logo-ct.png') }}" alt="Logo CT Olof Palme" class="h-16 w-auto object-contain">
            </div>
        </a>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl border-t-8 border-[#8cc63f]">
        <h2 class="text-2xl font-bold text-center text-[#003876] mb-2">Acceso Administrativo</h2>
        <p class="text-sm text-center text-gray-500 mb-8">Ingrese sus credenciales para gestionar la plataforma</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-bold text-[#003876] mb-2">Correo Electrónico</label>
                <input type="email" name="email" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-white transition" required autofocus>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-[#003876] mb-2">Contraseña</label>
                <input type="password" name="password" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-white transition" required>
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-[#0089D0] focus:ring-[#0089D0]">
                <label for="remember" class="ml-2 text-sm text-gray-600">Mantener sesión iniciada</label>
            </div>

            <button type="submit" class="w-full bg-[#0089D0] hover:bg-[#0074B2] text-white font-bold py-3 rounded-xl shadow-lg transition duration-300">
                Ingresar al Sistema
            </button>
            
            <div class="mt-6 text-center">
                <a href="#" class="text-sm text-gray-500 hover:text-[#0089D0] transition">¿Olvidó su contraseña?</a>
            </div>
        </form>
    </div>

    <x-notificaciones />
</body>
</html>