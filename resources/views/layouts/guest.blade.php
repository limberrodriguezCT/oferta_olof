<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Principal | CT Olof Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800 font-sans min-h-screen flex flex-col" 
      style="
        background-color: #EBE9E1;
        background-image: 
          linear-gradient(to right, rgba(0, 56, 118, 0.05) 1px, transparent 1px),
          linear-gradient(to bottom, rgba(0, 56, 118, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
      ">

    <nav class="bg-[#003876] border-b-4 border-[#8cc63f] h-16 z-50 shadow-md">
        <div class="w-full flex justify-between items-center h-full pr-4">
            
            <div class="flex items-center h-full">
                <div class="bg-white h-full px-6 flex items-center rounded-br-[2rem] shadow-sm">
                    <img src="{{ asset('img/logo-ct.png') }}" class="h-10 w-auto" alt="Logo">
                </div>
                
                <div class="hidden md:flex space-x-8 ml-10 h-full">
                    <a href="{{ route('dashboard') }}" class="text-[#8cc63f] font-bold border-b-4 border-[#8cc63f] h-full flex items-center px-1">
                        Panel Principal
                    </a>
                    <a href="#" class="text-white hover:text-gray-200 font-semibold h-full flex items-center px-1 transition">
                        Especialidades
                    </a>
                    <a href="#" class="text-white hover:text-gray-200 font-semibold h-full flex items-center px-1 transition">
                        Prospectos
                    </a>
                </div>
                
                <div class="ml-8 hidden md:flex items-center">
                    <a href="{{ route('inicio') ?? url('/') }}" target="_blank" class="bg-[#0089D0] text-white px-5 py-1.5 rounded-full text-xs font-black tracking-wide shadow hover:bg-blue-600 transition uppercase">
                        Ver Sitio Web
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-white text-[#003876] px-5 py-1.5 rounded-full text-sm font-bold flex items-center gap-2 shadow-sm hover:bg-gray-100 transition">
                        Dirección Olof Palme 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center border-l-8 border-[#8cc63f]">
                <div class="p-4 bg-green-50 rounded-xl text-[#8cc63f] mr-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-extrabold text-gray-500 tracking-wider uppercase mb-1">Especialidades Activas</p>
                    <p class="text-4xl font-black text-[#003876]">{{ $totalCarreras ?? '1' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 flex items-center border-l-8 border-[#0089D0]">
                <div class="p-4 bg-blue-50 rounded-xl text-[#0089D0] mr-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-extrabold text-gray-500 tracking-wider uppercase mb-1">Total de Prospectos</p>
                    <p class="text-4xl font-black text-[#003876]">{{ $totalInteresados ?? '1' }}</p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-md p-8">
            <h3 class="text-xl font-black text-[#003876] mb-6">Demanda por Especialidad</h3>
            <div class="relative h-96 w-full">
                <div class="w-full h-full bg-[#0089D0] rounded-xl flex items-center justify-center text-white font-bold opacity-90 shadow-inner">
                    Gráfico de Demanda
                </div>
            </div>
        </div>

    </main>

    <x-notificaciones />
</body>
</html>