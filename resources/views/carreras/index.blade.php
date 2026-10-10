<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Carreras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold">Listado de Oferta Académica</h3>
                        <a href="{{ route('carreras.create') }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Nueva Carrera
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Nombre</th>
                                    <th class="px-6 py-3">Nivel</th>
                                    <th class="px-6 py-3">Año</th>
                                    <th class="px-6 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carreras as $carrera)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $carrera->nombre }}</td>
                                        <td class="px-6 py-4">{{ $carrera->nivel_formacion }}</td>
                                        <td class="px-6 py-4">{{ $carrera->anio_academico }}</td>
                                        <td class="px-6 py-4 flex justify-center gap-4">
                                            <a href="{{ route('carreras.edit', $carrera) }}" class="text-blue-600 hover:underline">Editar</a>
                                            <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar esta carrera?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>