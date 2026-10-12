<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $carrera->nombre }} | CT Olof Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800 font-sans" 
      style="
        background-color: #EBE9E1;
        background-image: 
          linear-gradient(to right, rgba(0, 56, 118, 0.05) 1px, transparent 1px),
          linear-gradient(to bottom, rgba(0, 56, 118, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
      ">

    <!-- Encabezado con Logo -->
    <header class="bg-white shadow-md py-3 sticky top-0 z-40 border-b-4 border-[#8cc63f]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('img/logo-ct.png') }}" alt="Logo CT Olof Palme" class="h-14 w-auto object-contain">
                </a>
            </div>
            <div>
                <a href="{{ route('inicio') }}" class="text-[#0089D0] font-bold hover:text-[#8cc63f] transition duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver al Inicio
                </a>
            </div>
        </div>
    </header>

    <!-- Presentación Principal de la Carrera -->
    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-t-8 border-[#003876] flex flex-col md:flex-row">
            @if ($carrera->imagen_ruta)
                <div class="md:w-1/2">
                    <img src="{{ asset('storage/' . $carrera->imagen_ruta) }}" alt="{{ $carrera->nombre }}" class="w-full h-full object-cover min-h-[300px]">
                </div>
            @endif
            <div class="p-10 md:w-1/2 flex flex-col justify-center">
                <span class="inline-block bg-green-100 text-[#8cc63f] px-4 py-2 rounded-full text-sm font-extrabold mb-4 self-start tracking-wide uppercase shadow-sm">
                    {{ $carrera->nivel_formacion }}
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-[#003876] mb-6 leading-tight">{{ $carrera->nombre }}</h1>
                <div class="flex flex-wrap gap-4 mb-2">
                    <span class="bg-[#0089D0] text-white px-4 py-2 rounded-lg font-bold text-sm shadow">Duración: {{ $carrera->duracion }}</span>
                    <span class="bg-gray-100 text-[#003876] px-4 py-2 border border-gray-300 rounded-lg font-bold text-sm shadow-sm">Oferta {{ $carrera->anio_academico }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Detalles, Video y Formulario -->
    <section class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Columna Izquierda: Información Técnica -->
        <div class="lg:col-span-7 space-y-8">
            
            <!-- Perfil Profesional -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-l-8 border-[#8cc63f]">
                <h3 class="text-2xl font-extrabold text-[#003876] mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#8cc63f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Perfil Profesional
                </h3>
                @if (!empty($carrera->perfil_profesional))
                    <ul class="list-disc pl-5 text-gray-700 leading-relaxed font-medium space-y-1">
                        @php
                            $perfiles_array = explode("\n", $carrera->perfil_profesional);
                        @endphp
                        
                        @foreach ($perfiles_array as $perfil)
                            @if (trim($perfil) != '')
                                <li>{{ trim($perfil) }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700 leading-relaxed font-medium">Información no especificada.</p>
                @endif
            </div>

            <!-- Cargos u Ocupaciones -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-l-8 border-[#0089D0]">
                <h3 class="text-2xl font-extrabold text-[#003876] mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#0089D0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Cargos u Ocupaciones
                </h3>
                @if (!empty($carrera->cargos_ocupaciones))
                    <ul class="list-disc pl-5 text-gray-700 leading-relaxed font-medium space-y-1">
                        @php
                            $cargos_array = explode("\n", $carrera->cargos_ocupaciones);
                        @endphp
                        
                        @foreach ($cargos_array as $cargo)
                            @if (trim($cargo) != '')
                                <li>{{ trim($cargo) }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700 leading-relaxed font-medium">Información no especificada.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ámbito Profesional -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-extrabold text-[#003876] mb-2">Ámbito Profesional</h3>
                    @if (!empty($carrera->ambito_profesional))
                        <ul class="list-disc pl-5 text-gray-700 font-medium space-y-1">
                            @php
                                $ambitos_array = explode("\n", $carrera->ambito_profesional);
                            @endphp
                            
                            @foreach ($ambitos_array as $ambito)
                                @if (trim($ambito) != '')
                                    <li>{{ trim($ambito) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-700 font-medium">Información no especificada.</p>
                    @endif
                </div>
                
                <!-- Requisitos de Ingreso -->
                <div class="bg-blue-50 p-6 rounded-2xl border border-[#0089D0] shadow-sm">
                    <h3 class="text-lg font-extrabold text-[#0089D0] mb-2">Requisitos de Ingreso</h3>
                    @if (!empty($carrera->requisitos))
                        <ul class="list-disc pl-5 text-[#003876] font-bold space-y-1">
                            @php
                                $requisitos_array = explode("\n", $carrera->requisitos);
                            @endphp
                            
                            @foreach ($requisitos_array as $requisito)
                                @if (trim($requisito) != '')
                                    <li>{{ trim($requisito) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p class="text-[#003876] font-bold">Información no especificada.</p>
                    @endif
                </div>
            </div>

        </div>

        <!-- Columna Derecha: Video y Formulario de Matrícula -->
        <div class="lg:col-span-5 space-y-8">
            
            @if ($carrera->embed_video)
                <div class="bg-white p-2 rounded-2xl shadow-xl border-4 border-gray-100">
                    <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden bg-black">
                        <iframe src="{{ $carrera->embed_video }}" title="Video de la Especialidad" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-[250px] md:h-[300px]"></iframe>
                    </div>
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-8 border-[#E91E63] relative overflow-hidden">
                <h3 class="text-2xl font-black text-[#003876] mb-2 uppercase">¡Asegure su cupo!</h3>
                <p class="text-gray-600 mb-6 font-medium">Deje sus datos y nos contactaremos para la matrícula en esta especialidad.</p>
                
                <form action="{{ route('interesados.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Nombre Completo</label>
                        <input type="text" name="nombre_completo" class="w-full rounded-xl border-gray-300 focus:border-[#E91E63] focus:ring-[#E91E63] bg-gray-50 focus:bg-white transition" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Teléfono (WhatsApp)</label>
                        <input type="text" name="telefono" class="w-full rounded-xl border-gray-300 focus:border-[#E91E63] focus:ring-[#E91E63] bg-gray-50 focus:bg-white transition" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Correo Electrónico (Opcional)</label>
                        <input type="email" name="correo" class="w-full rounded-xl border-gray-300 focus:border-[#E91E63] focus:ring-[#E91E63] bg-gray-50 focus:bg-white transition">
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Especialidad de Interés</label>
                        <select name="carrera_id" class="w-full rounded-xl border-gray-300 focus:border-[#E91E63] focus:ring-[#E91E63] bg-gray-50 transition" required>
                            @foreach ($carreras as $opcion)
                                <option value="{{ $opcion->id }}" {{ $carrera->id == $opcion->id ? 'selected' : '' }}>
                                    {{ $opcion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#E91E63] hover:bg-pink-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1 text-lg">
                        Enviar mi información
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- Pie de página -->
    <footer class="bg-[#003876] text-white py-8 text-center mt-10">
        <div class="max-w-7xl mx-auto px-4">
            <h4 class="font-extrabold text-xl tracking-wide mb-2">Centro Tecnológico Olof Palme, Estelí</h4>
            <p class="text-[#0089D0] font-semibold">Educación Técnica Gratuita y de Calidad.</p>
        </div>
    </footer>

    <x-notificaciones />
</body>
</html>