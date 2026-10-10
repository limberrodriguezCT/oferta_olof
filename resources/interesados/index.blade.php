<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de Interesados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold">Listado de Prospectos</h3>
                        <!-- El botón de Excel se implementará en la siguiente fase -->
                        <button class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded cursor-not-allowed opacity-50">
                            Exportar Excel
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Nombre Completo</th>
                                    <th class="px-6 py-3">Teléfono</th>
                                    <th class="px-6 py-3">Correo</th>
                                    <th class="px-6 py-3">Carrera de Interés</th>
                                    <th class="px-6 py-3">Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($interesados as $interesado)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $interesado->nombre_completo }}</td>
                                        <td class="px-6 py-4">{{ $interesado->telefono }}</td>
                                        <td class="px-6 py-4">{{ $interesado->correo ?? 'No proporcionado' }}</td>
                                        <td class="px-6 py-4">{{ $interesado->carrera->nombre }} ({{ $interesado->carrera->anio_academico }})</td>
                                        <td class="px-6 py-4">{{ $interesado->created_at->format('d/m/Y h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay interesados registrados por el momento.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>