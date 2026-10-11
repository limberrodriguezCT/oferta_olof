<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#003876]">Listado de Oferta Académica</h3>
                    <a href="{{ route('carreras.create') }}" class="bg-[#8cc63f] hover:bg-[#7db61c] text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Nueva Carrera
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                        <thead class="text-xs text-white uppercase bg-[#003876]">
                            <tr>
                                <th class="px-6 py-4 rounded-tl-lg">Nombre de la Especialidad</th>
                                <th class="px-6 py-4">Nivel de Formación</th>
                                <th class="px-6 py-4">Duración</th>
                                <th class="px-6 py-4 text-center">Año</th>
                                <th class="px-6 py-4 text-center rounded-tr-lg">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($carreras as $carrera)
                                <tr class="bg-white border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-[#0089D0]">{{ $carrera->nombre }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $carrera->nivel_formacion }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $carrera->duracion }}</td>
                                    <td class="px-6 py-4 text-center font-medium">{{ $carrera->anio_academico }}</td>
                                    <td class="px-6 py-4 flex justify-center gap-4">
                                        <a href="{{ route('carreras.edit', $carrera) }}" class="text-[#0089D0] hover:text-[#003876] font-bold transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Editar
                                        </a>
                                        <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar esta especialidad permanentemente?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No se han registrado especialidades todavía.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>