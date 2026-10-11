<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#003876]">Listado de Prospectos</h3>
                    
                    <a href="{{ route('interesados.export') }}" class="bg-[#8cc63f] hover:bg-[#7db61c] text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Exportar Excel
                    </a>
                </div>

                <div class="overflow-x-auto mt-6">
                    <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                        <thead class="text-xs text-white uppercase bg-[#003876]">
                            <tr>
                                <th class="px-6 py-4 rounded-tl-lg">Nombre Completo</th>
                                <th class="px-6 py-4">Teléfono</th>
                                <th class="px-6 py-4">Correo</th>
                                <th class="px-6 py-4">Carrera de Interés</th>
                                <th class="px-6 py-4 rounded-tr-lg">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($interesados as $interesado)
                                <tr class="bg-white border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $interesado->nombre_completo }}</td>
                                    <td class="px-6 py-4">{{ $interesado->telefono }}</td>
                                    <td class="px-6 py-4">{{ $interesado->correo ?? 'No proporcionado' }}</td>
                                    <td class="px-6 py-4 text-[#0089D0] font-semibold">{{ $interesado->carrera->nombre }} ({{ $interesado->carrera->anio_academico }})</td>
                                    <td class="px-6 py-4">{{ $interesado->created_at->format('d/m/Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No hay interesados registrados por el momento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>