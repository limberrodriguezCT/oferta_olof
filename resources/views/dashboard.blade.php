<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-8 border-[#8cc63f] p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-[#8cc63f] mr-4 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Especialidades Activas</p>
                        <p class="text-4xl font-extrabold text-[#003876] mt-1">{{ $totalCarreras }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-8 border-[#0089D0] p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-[#0089D0] mr-4 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Total de Prospectos</p>
                        <p class="text-4xl font-extrabold text-[#003876] mt-1">{{ $totalInteresados }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border border-gray-100">
            <h3 class="text-xl font-extrabold text-[#003876] mb-6">Demanda por Especialidad</h3>
            <div class="relative h-96 w-full">
                <canvas id="graficoProspectos"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('graficoProspectos').getContext('2d');
            
            const nombresCarreras = @json($nombresCarreras);
            const totalesPorCarrera = @json($totalesPorCarrera);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombresCarreras,
                    datasets: [{
                        label: 'Número de Interesados',
                        data: totalesPorCarrera,
                        backgroundColor: '#0089D0',
                        hoverBackgroundColor: '#8cc63f',
                        borderRadius: 6,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: "'Figtree', sans-serif",
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    family: "'Figtree', sans-serif"
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#003876',
                            padding: 12,
                            titleFont: { size: 14, family: "'Figtree', sans-serif" },
                            bodyFont: { size: 14, family: "'Figtree', sans-serif" },
                            cornerRadius: 8
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>