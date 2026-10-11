<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-t-8 border-[#003876]">
            <div class="p-8 text-gray-900">
                <div class="flex items-center gap-3 mb-8 pb-4 border-b border-gray-200">
                    <a href="{{ route('carreras.index') }}" class="text-gray-400 hover:text-[#0089D0] transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    </a>
                    <h3 class="text-2xl font-extrabold text-[#003876]">Registrar Nueva Especialidad</h3>
                </div>

                <form action="{{ route('carreras.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Nombre de la Carrera</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            @error('nombre') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Nivel de Formación</label>
                            <select name="nivel_formacion" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                                <option value="">Seleccione un nivel</option>
                                <option value="Técnico General" {{ old('nivel_formacion') == 'Técnico General' ? 'selected' : '' }}>Técnico General</option>
                                <option value="Técnico Especialista" {{ old('nivel_formacion') == 'Técnico Especialista' ? 'selected' : '' }}>Técnico Especialista</option>
                                <option value="Bachillerato Técnico" {{ old('nivel_formacion') == 'Bachillerato Técnico' ? 'selected' : '' }}>Bachillerato Técnico</option>
                            </select>
                            @error('nivel_formacion') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Perfil Profesional</label>
                        <textarea name="perfil_profesional" rows="4" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('perfil_profesional') }}</textarea>
                        @error('perfil_profesional') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Cargos u Ocupaciones</label>
                        <textarea name="cargos_ocupaciones" rows="4" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('cargos_ocupaciones') }}</textarea>
                        @error('cargos_ocupaciones') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Duración</label>
                            <textarea type="text" name="duracion" value="{{ old('duracion') }}" placeholder="Ej: 2 años" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required></textarea>
                            @error('duracion') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Año Académico</label>
                            <input type="number" name="anio_academico" value="{{ old('anio_academico', date('Y') + 1) }}" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>
                            @error('anio_academico') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Ámbito Profesional</label>
                        <textarea name="ambito_profesional" rows="3" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('ambito_profesional') }}</textarea>
                        @error('ambito_profesional') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003876] mb-2">Requisitos de Ingreso</label>
                        <textarea name="requisitos" rows="3" class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" required>{{ old('requisitos') }}</textarea>
                        @error('requisitos') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">Imagen de la Especialidad</label>
                            <input type="file" name="imagen_ruta" accept="image/*" class="w-full text-gray-700 bg-white border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-[#0089D0]">
                            <p class="text-xs text-gray-500 mt-2">Formatos recomendados: JPG, PNG (Max 2MB)</p>
                            @error('imagen_ruta') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#003876] mb-2">URL del Video (YouTube)</label>
                            <input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-white transition">
                            <p class="text-xs text-gray-500 mt-2">Pegue el enlace completo del video de YouTube.</p>
                            @error('video_url') <span class="text-red-500 text-sm font-medium mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-gray-200 pt-6">
                        <a href="{{ route('carreras.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-6 rounded-xl shadow-sm transition duration-200">Cancelar</a>
                        <button type="submit" class="bg-[#8cc63f] hover:bg-[#7db61c] text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Guardar Carrera
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>