<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oferta Académica - Centro Tecnológico Olof Palme</title>
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

    <header class="bg-white shadow-md py-3 sticky top-0 z-40 border-b-4 border-[#8cc63f]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                @php
                    $logoPath = public_path('img/logo-ct.png');
                    $logoVersion = file_exists($logoPath) ? filemtime($logoPath) : '1';
                @endphp
                <img src="{{ asset('img/logo-ct.png') }}?v={{ $logoVersion }}" alt="Logo CT Olof Palme" class="h-14 w-auto object-contain">
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

    <!-- Carrusel del Centro con Flechas y evasión de caché automática -->
    <section class="max-w-6xl mx-auto px-4 mb-16 mt-8">
        <h3 class="text-3xl font-extrabold text-center text-[#003876] mb-8">Conoce Nuestro centro:</h3>
        
        <div class="relative bg-white p-3 rounded-3xl shadow-xl border border-gray-200 group">
            
            <!-- Botón Anterior -->
            <button id="btn-prev" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-[#003876] p-3 rounded-full shadow-xl z-20 transition duration-300 transform hover:scale-110 border border-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <!-- Contenedor de las fotos -->
            <div id="carrusel-centro" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scroll-smooth relative z-10" style="scrollbar-width: none; -ms-overflow-style: none;">
                <style>#carrusel-centro::-webkit-scrollbar { display: none; }</style>
                
                @php
                    $imagenesCentro = [
                        'centro1.jpg',
                        'centro2.jpg',
                        'centro3.jpg',
                        'centro4.jpg',
                        'centro5.jpg',
                        'centro6.jpg',
                        'centro7.jpg',
                        'centro8.jpg',
                        'centro9.jpg',
                        'centro10.jpg',
                        'centro11.jpg',
                        'centro12.jpg',
                    ];
                @endphp

                @foreach($imagenesCentro as $img)
                    @php
                        $rutaFisica = public_path('img/' . $img);
                        $version = file_exists($rutaFisica) ? filemtime($rutaFisica) : '1';
                    @endphp
                    <div class="snap-center shrink-0 w-full md:w-3/4 lg:w-2/3 h-[400px] md:h-[500px] rounded-2xl overflow-hidden relative shadow-md">
                        <img src="{{ asset('img/' . $img) }}?v={{ $version }}" alt="Instalaciones del Centro" class="w-full h-full object-cover bg-gray-200">
                    </div>
                @endforeach

            </div>

            <!-- Botón Siguiente -->
            <button id="btn-next" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-[#003876] p-3 rounded-full shadow-xl z-20 transition duration-300 transform hover:scale-110 border border-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </section>

    <!-- Script de navegación con flechas y auto-reproducción -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carrusel = document.getElementById('carrusel-centro');
            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');
            
            if (!carrusel) return;

            const moverDerecha = () => {
                if (carrusel.scrollLeft + carrusel.clientWidth >= carrusel.scrollWidth - 10) {
                    carrusel.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    carrusel.scrollBy({ left: carrusel.clientWidth, behavior: 'smooth' });
                }
            };

            const moverIzquierda = () => {
                if (carrusel.scrollLeft <= 0) {
                    carrusel.scrollTo({ left: carrusel.scrollWidth, behavior: 'smooth' });
                } else {
                    carrusel.scrollBy({ left: -carrusel.clientWidth, behavior: 'smooth' });
                }
            };

            btnNext.addEventListener('click', moverDerecha);
            btnPrev.addEventListener('click', moverIzquierda);

            let intervalo = setInterval(moverDerecha, 3500);

            // Pausa el carrusel cuando se pasa el mouse por encima
            carrusel.parentElement.addEventListener('mouseenter', () => clearInterval(intervalo));
            carrusel.parentElement.addEventListener('mouseleave', () => intervalo = setInterval(moverDerecha, 3500));
        });
    </script>

    <section class="max-w-7xl mx-auto px-4 mb-16" id="carreras">
        <h3 class="text-3xl font-extrabold text-center text-[#003876] mb-10">Conozca Nuestras Especialidades</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($carreras as $carrera)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border-b-4 border-[#0089D0] flex flex-col group">
                    
                    @if($carrera->imagen_ruta)
                        @php
                            $rutaImagenCarrera = public_path('storage/' . $carrera->imagen_ruta);
                            $versionCarrera = file_exists($rutaImagenCarrera) ? filemtime($rutaImagenCarrera) : '1';
                        @endphp
                        <img src="{{ asset('storage/' . $carrera->imagen_ruta) }}?v={{ $versionCarrera }}" alt="{{ $carrera->nombre }}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
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

    <section class="bg-white py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
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