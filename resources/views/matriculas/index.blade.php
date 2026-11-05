<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2 mb-8">
            <h1 class="text-3xl font-extrabold text-[#003876]">Matrículas por carrera</h1>
            <p class="text-gray-600">Seleccione una carrera para consultar sus matrículas y darles seguimiento.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($carreras as $carrera)
                <x-matricula-carrera-card :nombre="$carrera->nombre" :anio="$carrera->anio_academico" :total="$carrera->matriculas_count" :no-vistas="$carrera->no_vistas_count" :href="route('matriculas.listado', ['carrera_id' => $carrera->id])" />
            @endforeach
            @foreach($archivadas as $archivo)
                <x-matricula-carrera-card :nombre="$archivo->carrera_nombre" :anio="$archivo->anio_academico" :total="$archivo->matriculas_count" :no-vistas="$archivo->no_vistas_count" :href="route('matriculas.listado', ['nombre' => $archivo->carrera_nombre, 'anio' => $archivo->anio_academico])" :archivada="true" />
            @endforeach
        </div>
        @if($carreras->isEmpty() && $archivadas->isEmpty())
            <p class="bg-white rounded-2xl shadow-lg p-10 text-center text-gray-500">Todavía no hay carreras ni matrículas registradas.</p>
        @endif
    </div>
</x-app-layout>
