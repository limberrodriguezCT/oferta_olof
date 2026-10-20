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

    <!-- Encabezado -->
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

    <!-- Carrusel del Centro -->
    <section class="max-w-6xl mx-auto px-4 mb-16 mt-8">
        <h3 class="text-3xl font-extrabold text-center text-[#003876] mb-8">Conoce Nuestro centro:</h3>
        
        <div class="relative bg-white p-3 rounded-3xl shadow-xl border border-gray-200 group">
            <button id="btn-prev" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-[#003876] p-3 rounded-full shadow-xl z-20 transition duration-300 transform hover:scale-110 border border-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <div id="carrusel-centro" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scroll-smooth relative z-10" style="scrollbar-width: none; -ms-overflow-style: none;">
                <style>#carrusel-centro::-webkit-scrollbar { display: none; }</style>
                
                @php
                    $imagenesCentro = [
                        'centro1.jpg', 'centro2.jpg', 'centro3.jpg', 'centro4.jpg',
                        'centro5.jpg', 'centro6.jpg', 'centro7.jpg', 'centro8.jpg',
                        'centro9.jpg', 'centro10.jpg', 'centro11.jpg', 'centro12.jpg',
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

            <button id="btn-next" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-[#003876] p-3 rounded-full shadow-xl z-20 transition duration-300 transform hover:scale-110 border border-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </section>

    <!-- Script del Carrusel -->
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
            carrusel.parentElement.addEventListener('mouseenter', () => clearInterval(intervalo));
            carrusel.parentElement.addEventListener('mouseleave', () => intervalo = setInterval(moverDerecha, 3500));
        });
    </script>

    <!-- Tarjetas de Especialidades -->
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

    <!-- Formulario General y Mapa -->
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

    <!-- Redes Sociales -->
    <section class="max-w-5xl mx-auto px-4 mb-16 mt-8">
        <div class="bg-white rounded-3xl shadow-xl border-t-8 border-[#003876] p-8 md:p-12 text-center relative overflow-hidden">
            <h3 class="text-3xl font-black text-[#003876] mb-4">Únase a Nuestra Comunidad</h3>
            <p class="text-gray-600 mb-10 text-lg font-medium max-w-2xl mx-auto">Descubra nuestro día a día en nuestras redes sociales oficiales.</p>
            
            <div class="flex flex-col md:flex-row justify-center items-center gap-6">
                <!-- Tarjeta Facebook con color en línea para forzar compilación -->
                <a href="https://www.facebook.com/CTOlofPalme" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto flex items-center gap-4 px-8 py-4 bg-gray-50 hover:bg-blue-50 rounded-2xl border border-gray-100 hover:border-blue-200 transition duration-300 shadow-sm hover:shadow-md group">
                    <div class="p-3 rounded-full text-white group-hover:scale-110 transition duration-300 shadow-sm" style="background-color: #1877F2;">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-lg font-bold text-[#003876]">Facebook</h4>
                        <span class="text-sm text-gray-500 font-medium">@CTOlofPalme</span>
                    </div>
                </a>

                <!-- Tarjeta Instagram con color en línea para forzar compilación -->
                <a href="https://www.instagram.com/tecolofpalmeesteli?dlrf=eTByd3lwdHN3anh0" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto flex items-center gap-4 px-8 py-4 bg-gray-50 hover:bg-pink-50 rounded-2xl border border-gray-100 hover:border-pink-200 transition duration-300 shadow-sm hover:shadow-md group">
                    <div class="p-3 rounded-full text-white group-hover:scale-110 transition duration-300 shadow-sm" style="background-image: linear-gradient(to top right, #F58529, #DD2A7B, #8134AF);">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-lg font-bold text-[#003876]">Instagram</h4>
                        <span class="text-sm text-gray-500 font-medium">@tecolofpalmeesteli</span>
                    </div>
                </a>

                <!-- Tarjeta TikTok -->
                <a href="https://www.tiktok.com/@ctolofpalmeesteli" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto flex items-center gap-4 px-8 py-4 bg-gray-50 hover:bg-gray-100 rounded-2xl border border-gray-100 hover:border-gray-300 transition duration-300 shadow-sm hover:shadow-md group">
                    <div class="bg-black p-3 rounded-full text-white group-hover:scale-110 transition duration-300 shadow-sm">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-1.13 4.39-2.88 5.76-1.74 1.39-4.14 1.95-6.31 1.48-2.18-.46-4.09-1.87-5.18-3.79-1.09-1.92-1.13-4.32-.12-6.28 1.01-1.97 2.91-3.41 5.1-3.84 1.07-.22 2.18-.21 3.25.04v4.06c-.84-.18-1.74-.08-2.49.33-.76.41-1.34 1.09-1.6 1.91-.25.82-.13 1.73.31 2.45.45.72 1.2 1.25 2.05 1.41.84.17 1.74.02 2.45-.44.7-.45 1.22-1.18 1.39-2.01.07-.36.09-.73.08-1.11.02-4.71.01-9.42.02-14.13z"/></svg>
                    </div>
                    <div class="text-left">
                        <h4 class="text-lg font-bold text-[#003876]">TikTok</h4>
                        <span class="text-sm text-gray-500 font-medium">@ctolofpalmeesteli</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Original -->
    <footer class="bg-[#003876] text-white py-10 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#8cc63f] via-[#0089D0] to-[#E91E63]"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
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