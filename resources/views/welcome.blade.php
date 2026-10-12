<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oferta Académica - Centro Tecnológico Olof Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Fondo de cuadrícula tipo "papel milimetrado" generado 100% con CSS (sin imágenes) -->
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
                <img src="{{ asset('img/logo-ct.png') }}" alt="Logo CT Olof Palme" class="h-14 w-auto object-contain">
            </div>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-[#0089D0] font-bold hover:text-[#8cc63f] transition duration-300">Ir al Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-[#0089D0] font-bold hover:text-[#8cc63f] transition duration-300">Acceso Administrador</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Sección Hero -->
    <section class="py-16 text-center px-4">
        <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight drop-shadow-sm">
            <span class="text-[#0089D0]">YO </span><span class="text-[#E91E63]">ELIJO SER</span>
        </h2>
        <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight mt-1 drop-shadow-sm">
            <span class="text-[#003876]">Profesional </span><span class="text-[#0089D0]">TÉCNICO</span>
        </h2>
        <div class="mt-6 inline-block bg-[#8cc63f] text-white px-8 py-2 rounded-full text-2xl font-bold shadow-lg">
            Matrícula 2027!
        </div>
    </section>

    <!-- Video Institucional -->
    <section class="max-w-5xl mx-auto px-4 mb-16 mt-8">
        <div class="bg-white p-2 rounded-2xl shadow-xl border border-gray-200">
            <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden bg-black">
                <iframe class="w-full h-[400px] md:h-[500px]" src="https://www.youtube.com/embed/ID_DEL_VIDEO_PRINCIPAL" title="Video Institucional del Centro" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <!-- Tarjetas de Especialidades con enlace a la vista dinámica -->
    <section class="max-w-7xl mx-auto px-4 mb-16" id="carreras">
        <h3 class="text-3xl font-extrabold text-center text-[#003876] mb-10">Conozca Nuestras Especialidades</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($carreras as $carrera)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border-b-4 border-[#0089D0] flex flex-col group">
                    
                    @if($carrera->imagen_ruta)
                        <img src="{{ asset('storage/' . $carrera->imagen_ruta) }}" alt="{{ $carrera->nombre }}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-gray-400">Sin Imagen</div>
                    @endif
                    
                    <div class="p-6 flex-grow flex flex-col bg-white relative z-10">
                        <span class="text-xs font-bold bg-green-100 text-[#8cc63f] px-3 py-1 rounded-full uppercase tracking-wider mb-3 self-start">{{ $carrera->nivel_formacion }}</span>
                        <h4 class="text-xl font-bold text-[#003876] mb-3 leading-tight">{{ $carrera->nombre }}</h4>
                        <p class="text-gray-600 text-sm mb-5 line-clamp-3">{{ $carrera->perfil_profesional }}</p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('oferta.show', $carrera->id) }}" class="w-full block text-center bg-[#0089D0] hover:bg-[#0074B2] text-white font-semibold py-3 rounded-xl shadow-md transition duration-200">
                                Ver Detalles de la Carrera
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Formulario General y Mapa -->
    <section class="bg-white py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Formulario -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-[#8cc63f]"></div>
                
                <h3 class="text-2xl font-extrabold text-[#0089D0] mb-2">¿Le interesa alguna especialidad?</h3>
                <p class="text-gray-600 mb-8">Deje sus datos y nos pondremos en contacto para gestionar su matrícula.</p>
                
                <form action="{{ route('interesados.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Nombre Completo</label>
                        <input type="text" name="nombre_completo" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Teléfono (WhatsApp)</label>
                        <input type="text" name="telefono" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Correo Electrónico (Opcional)</label>
                        <input type="email" name="correo" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition">
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Especialidad de Interés</label>
                        <select name="carrera_id" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#0089D0] hover:bg-[#0074B2] text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1">
                        Enviar mi información
                    </button>
                </form>
            </div>

            <!-- Mapa -->
            <div class="flex flex-col h-full">
                <h3 class="text-2xl font-extrabold text-[#8cc63f] mb-2">Nuestra Ubicación</h3>
                <p class="text-gray-600 mb-6">Km 136 Carretera Panamericana Santa Cruz, Estelí.</p>
                
                <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-200 flex-grow min-h-[400px]">
                    <iframe 
                        src="https://maps.google.com/maps?q=Centro%20Tecnológico%20Olof%20Palme%20Esteli&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

    <!-- Pie de página -->
    <footer class="bg-[#003876] text-white py-10 text-center">
        <div class="max-w-7xl mx-auto px-4">
            <h4 class="font-extrabold text-2xl tracking-wide mb-2">Centro Tecnológico Olof Palme, Estelí</h4>
            <p class="text-[#0089D0] font-semibold text-lg">Educación Técnica Gratuita y de Calidad.</p>
            <div class="mt-6 border-t border-blue-800 pt-6 text-sm text-gray-400">
                &copy; {{ date('Y') }} INATEC. Todos los derechos reservados.
            </div>
        </div>
    </footer>
    
    <x-notificaciones />
</body>
</html>