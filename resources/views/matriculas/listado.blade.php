<x-app-layout>
    <div class="w-full min-w-0 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-6">
        <a href="{{ route('matriculas.index') }}" class="font-bold text-[#0089D0]">← Volver a carreras</a>
        <div><p class="text-sm font-bold text-[#0089D0]">Oferta {{ $anio }}</p><h1 class="text-3xl font-extrabold text-[#003876]">{{ $nombre }}</h1></div>
        @if($errors->any())<div role="alert" class="bg-red-50 border border-red-200 p-4 rounded-xl text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        @if(session('success'))<p role="status" class="bg-green-50 text-green-800 p-4 rounded-xl">{{ session('success') }}</p>@endif
        <form method="GET" action="{{ route('matriculas.listado') }}" class="min-w-0 bg-white p-6 rounded-2xl shadow-lg grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @foreach($grupo as $key => $value)<input type="hidden" name="{{ $key }}" value="{{ $value }}">@endforeach
            <div class="md:col-span-2"><label for="q" class="block text-sm font-bold text-[#003876] mb-2">Buscar participante</label><input id="q" name="q" value="{{ $filtros['q'] ?? '' }}" placeholder="Nombre, apellidos, cédula, teléfono o correo" maxlength="120" class="w-full rounded-xl border-gray-300 focus:ring-[#0089D0] focus:border-[#0089D0]"></div>
            <div><label for="desde" class="block text-sm font-bold text-[#003876] mb-2">Fecha desde</label><input type="date" id="desde" name="desde" value="{{ $filtros['desde'] ?? '' }}" class="w-full rounded-xl border-gray-300"></div>
            <div><label for="hasta" class="block text-sm font-bold text-[#003876] mb-2">Fecha hasta</label><input type="date" id="hasta" name="hasta" value="{{ $filtros['hasta'] ?? '' }}" class="w-full rounded-xl border-gray-300"></div>
            <div><label for="estado" class="block text-sm font-bold text-[#003876] mb-2">Estado</label><select id="estado" name="estado" class="w-full rounded-xl border-gray-300"><option value="">Todos los estados</option>@foreach($estados as $value => $label)<option value="{{ $value }}" @selected(($filtros['estado'] ?? '') === $value)>{{ $label }}</option>@endforeach</select></div>
            <div><label for="vista" class="block text-sm font-bold text-[#003876] mb-2">Lectura</label><select id="vista" name="vista" class="w-full rounded-xl border-gray-300"><option value="">Todas</option><option value="0" @selected((string) ($filtros['vista'] ?? '') === '0')>No vistas</option><option value="1" @selected((string) ($filtros['vista'] ?? '') === '1')>Vistas</option></select></div>
            <div><label for="orden" class="block text-sm font-bold text-[#003876] mb-2">Ordenar por</label><select id="orden" name="orden" class="w-full rounded-xl border-gray-300">@foreach(['recientes' => 'Más recientes', 'antiguas' => 'Más antiguas', 'nombre' => 'Nombre'] as $value => $label)<option value="{{ $value }}" @selected(($filtros['orden'] ?? 'recientes') === $value)>{{ $label }}</option>@endforeach</select></div>
            <div class="flex items-end gap-3"><button class="bg-[#0089D0] text-white font-bold px-5 py-3 rounded-xl hover:bg-[#003876]">Filtrar</button><a href="{{ route('matriculas.listado', $grupo) }}" class="font-bold text-gray-600 py-3">Limpiar</a></div>
        </form>
        <div class="min-w-0 overflow-hidden bg-white rounded-2xl shadow-xl p-6">
            <p class="font-bold text-[#003876] mb-4">{{ $matriculas->total() }} matrículas encontradas</p>
            <div class="overflow-x-auto"><table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-[#003876] text-white"><tr><th scope="col" class="p-4">Participante</th><th scope="col" class="p-4">Contacto</th><th scope="col" class="p-4">Fecha</th><th scope="col" class="p-4">Seguimiento</th><th scope="col" class="p-4">Hoja</th></tr></thead>
                <tbody>@forelse($matriculas as $matricula)
                    <tr class="border-b {{ $matricula->vista ? 'bg-white' : 'bg-blue-50' }}">
                        <td class="p-4"><p class="font-bold text-[#003876]">{{ collect([$matricula->primer_nombre, $matricula->segundo_nombre, $matricula->primer_apellido, $matricula->segundo_apellido])->filter()->implode(' ') }}</p><span class="inline-block rounded-full px-2 py-1 mt-2 text-xs {{ $matricula->vista ? 'bg-gray-100 text-gray-600' : 'bg-blue-100 text-blue-800' }}">{{ $matricula->vista ? 'Vista' : 'No vista' }}</span><p class="mt-2 font-medium text-[#003876]">{{ $estados[$matricula->estado] ?? $matricula->estado }}</p></td>
                        <td class="p-4"><p>{{ $matricula->telefono_celular }}</p><p class="text-gray-500">{{ $matricula->correo }}</p></td>
                        <td class="p-4 whitespace-nowrap">{{ $matricula->fecha_matricula->format('d/m/Y') }}</td>
                        <td class="p-4"><form method="POST" action="{{ route('matriculas.update', $matricula) }}" class="flex flex-col gap-2 min-w-[180px]">@csrf @method('PATCH')
                            <label for="vista-{{ $matricula->id }}" class="sr-only">Lectura de {{ $matricula->primer_nombre }}</label><select id="vista-{{ $matricula->id }}" name="vista" class="rounded-lg text-sm border-gray-300"><option value="0" @selected(!$matricula->vista)>No vista</option><option value="1" @selected($matricula->vista)>Vista</option></select>
                            <label for="estado-{{ $matricula->id }}" class="sr-only">Estado de {{ $matricula->primer_nombre }}</label><select id="estado-{{ $matricula->id }}" name="estado" class="rounded-lg text-sm border-gray-300">@foreach($estados as $value => $label)<option value="{{ $value }}" @selected($matricula->estado === $value)>{{ $label }}</option>@endforeach</select>
                            <button class="bg-[#003876] text-white rounded-lg px-3 py-2 font-bold">Guardar seguimiento</button>
                        </form></td>
                        <td class="p-4"><a href="{{ route('matriculas.print', $matricula) }}" target="_blank" rel="noopener" class="inline-block whitespace-nowrap bg-[#0089D0] hover:bg-[#003876] text-white font-bold px-4 py-2 rounded-xl">Ver / Imprimir</a></td>
                    </tr>
                @empty<tr><td colspan="5" class="p-10 text-center text-gray-500">No hay matrículas que coincidan con los filtros.</td></tr>@endforelse</tbody>
            </table></div>
            <div class="mt-6">{{ $matriculas->links() }}</div>
        </div>
    </div>
</x-app-layout>
