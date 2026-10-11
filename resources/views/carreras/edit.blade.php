<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-t-8 border-[#0089D0]">
            <div class="p-8 text-gray-900">
                <div class="flex items-center gap-3 mb-8 pb-4 border-b border-gray-200">
                    <a href="{{ route('carreras.index') }}" class="text-gray-400 hover:text-[#0089D0] transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    </a>
                    <h3 class="text-2xl font-extrabold text-[#003876]">Editar Especialidad: <span class="text-[#0089D0]">{{ $carrera->nombre }}</span></h3>
                </div>

                <form action="{{ route('carreras.update', $carrera) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Nombre de la Carrera</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            @error('nombre') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Nivel de Formación</label>
                            <select name="nivel_formacion" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                                <option value="">Seleccione un nivel</option>
                                <option value="Técnico General" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Técnico General' ? 'selected' : '' }}>Técnico General</option>
                                <option value="Técnico Especialista" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Técnico Especialista' ? 'selected' : '' }}>Técnico Especialista</option>
                                <option value="Bachillerato Técnico" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Bachillerato Técnico' ? 'selected' : '' }}>Bachillerato Técnico</option>
                            </select>
                            @error('nivel_formacion') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Perfil Profesional</label>
                        <textarea name="perfil_profesional" rows="4" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('perfil_profesional', $carrera->perfil_profesional) }}</textarea>
                        @error('perfil_profesional') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Cargos u Ocupaciones</label>
                        <textarea name="cargos_ocupaciones" rows="4" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('cargos_ocupaciones', $carrera->cargos_ocupaciones) }}</textarea>
                        @error('cargos_ocupaciones') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Duración</label>
                            <input type="text" name="duracion" value="{{ old('duracion', $carrera->duracion) }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            @error('duracion') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Año Académico</label>
                            <input type="number" name="anio_academico" value="{{ old('anio_academico', $carrera->anio_academico) }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            @error('anio_academico') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Ámbito Profesional</label>
                        <textarea name="ambito_profesional" rows="3" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('ambito_profesional', $carrera->ambito_profesional) }}</textarea>
                        @error('ambito_profesional') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Requisitos de Ingreso</label>
                        <textarea name="requisitos" rows="3" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('requisitos', $carrera->requisitos) }}</textarea>
                        @error('requisitos') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Imagen de la Especialidad (Opcional)</label>
                            <input type="file" name="imagen_ruta" accept="image/*" class="w-full text-gray-700 bg-white border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#0089D0]">
                            <p class="text-xs text-gray-500 mt-2">Déjelo en blanco si desea conservar la imagen actual.</p>
                            @if($carrera->imagen_ruta)
                                <div class="mt-4">
                                    <p class="text-xs font-bold text-[#003876] mb-1">Imagen Actual:</p>
                                    <img src="{{ asset('storage/' . $carrera->imagen_ruta) }}" alt="Imagen actual" class="h-24 w-auto rounded-lg shadow-sm border border-gray-200">
                                </div>
                            @endif
                            @error('imagen_ruta') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">URL del Video (YouTube)</label>
                            <input type="url" name="video_url" value="{{ old('video_url', $carrera->video_url) }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-white transition">
                            @error('video_url') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-gray-200 pt-6">
                        <a href="{{ route('carreras.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-6 rounded-xl shadow-sm transition duration-200">Cancelar</a>
                        <button type="submit" class="bg-[#0089D0] hover:bg-[#0074B2] text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Actualizar Carrera
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>