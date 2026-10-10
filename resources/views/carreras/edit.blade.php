<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Carrera: ') . $carrera->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('carreras.update', $carrera) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre de la Carrera</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $carrera->nombre) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nivel de Formación</label>
                                <select name="nivel_formacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Seleccione un nivel</option>
                                    <option value="Técnico General" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Técnico General' ? 'selected' : '' }}>Técnico General</option>
                                    <option value="Técnico Especialista" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Técnico Especialista' ? 'selected' : '' }}>Técnico Especialista</option>
                                    <option value="Bachillerato Técnico" {{ old('nivel_formacion', $carrera->nivel_formacion) == 'Bachillerato Técnico' ? 'selected' : '' }}>Bachillerato Técnico</option>
                                </select>
                                @error('nivel_formacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Perfil Profesional</label>
                            <textarea name="perfil_profesional" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('perfil_profesional', $carrera->perfil_profesional) }}</textarea>
                            @error('perfil_profesional') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cargos u Ocupaciones</label>
                            <textarea name="cargos_ocupaciones" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('cargos_ocupaciones', $carrera->cargos_ocupaciones) }}</textarea>
                            @error('cargos_ocupaciones') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Duración</label>
                                <input type="text" name="duracion" value="{{ old('duracion', $carrera->duracion) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('duracion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Año Académico</label>
                                <input type="number" name="anio_academico" value="{{ old('anio_academico', $carrera->anio_academico) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('anio_academico') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Ámbito Profesional</label>
                            <textarea name="ambito_profesional" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('ambito_profesional', $carrera->ambito_profesional) }}</textarea>
                            @error('ambito_profesional') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Requisitos</label>
                            <textarea name="requisitos" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('requisitos', $carrera->requisitos) }}</textarea>
                            @error('requisitos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Imagen de la Carrera (Dejar en blanco para mantener la actual)</label>
                                <input type="file" name="imagen_ruta" accept="image/*" class="mt-1 block w-full text-gray-700 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @if($carrera->imagen_ruta)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $carrera->imagen_ruta) }}" alt="Imagen actual" class="h-20 w-auto">
                                    </div>
                                @endif
                                @error('imagen_ruta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">URL del Video (YouTube)</label>
                                <input type="url" name="video_url" value="{{ old('video_url', $carrera->video_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('video_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('carreras.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Cancelar</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Actualizar Carrera</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>