<?php

namespace App\Exports;

use App\Models\Interesado;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InteresadosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return Interesado::with('carrera')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Fecha de Registro',
            'Nombre Completo',
            'Teléfono',
            'Correo Electrónico',
            'Carrera de Interés',
            'Nivel de Formación',
            'Año Académico'
        ];
    }

    public function map($interesado): array
    {
        return [
            $interesado->created_at->format('d/m/Y h:i A'),
            $interesado->nombre_completo,
            $interesado->telefono,
            $interesado->correo ?? 'No proporcionado',
            $interesado->carrera->nombre,
            $interesado->carrera->nivel_formacion,
            $interesado->carrera->anio_academico,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], 
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '003876']]
            ],
        ];
    }
}