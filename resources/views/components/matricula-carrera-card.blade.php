@props(['nombre', 'anio', 'total', 'noVistas', 'href', 'archivada' => false])
<a href="{{ $href }}" class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition border-t-4 border-[#8cc63f] p-6 flex flex-col gap-5 focus:outline-none focus:ring-2 focus:ring-[#0089D0]">
    <div class="flex justify-between items-center gap-3"><span class="text-sm font-bold text-[#0089D0]">Oferta {{ $anio }}</span>@if($archivada)<span class="text-xs rounded-full bg-gray-100 text-gray-600 px-3 py-1">Carrera eliminada</span>@endif</div>
    <h2 class="text-xl font-extrabold text-[#003876] flex-grow">{{ $nombre }}</h2>
    <div class="flex justify-between items-end gap-3"><div><span class="text-4xl font-black text-[#003876]">{{ $total }}</span><span class="block text-sm text-gray-500">Matrículas recibidas</span></div><span class="bg-pink-50 text-pink-700 text-sm font-bold px-3 py-2 rounded-xl">{{ $noVistas }} sin ver</span></div>
    <span class="text-[#0089D0] font-bold border-t border-gray-100 pt-4">Ver matrículas →</span>
</a>
