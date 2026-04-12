<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PlanillaRefrigeriosExport implements FromView, ShouldAutoSize,WithStyles,WithColumnFormatting
{
    protected $datos_planilla, $diasDelMes,$tipo_cargo,$diasLiteral;
    public function __construct($datos_planilla,$diasDelMes,$tipo_cargo,$diasLiteral)
    {
        $this->datos_planilla = $datos_planilla;
        $this->diasDelMes = $diasDelMes;
        $this->tipo_cargo = $tipo_cargo;
        $this->diasLiteral = $diasLiteral;
    }

    public function view(): View
    {
        return view('planillas.xls.planilla_refrigerios',
        [
            'reporteMensual' => $this->datos_planilla,
            'diasEnMes' => $this->diasDelMes,
            'tipo_cargo' => $this->tipo_cargo,
            'diasLiteral' => $this->diasLiteral,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        if($this->tipo_cargo!='ITEM'){
            $sheet->getStyle('A3:AI3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('E4:AI4')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('Aj3:As3')->getAlignment()->setTextRotation(90);
            $sheet->getStyle('B')->getAlignment()->setWrapText(true);
            $sheet->getStyle('C')->getAlignment()->setWrapText(true);
            $sheet->getStyle('D')->getAlignment()->setWrapText(true);
            $sheet->getStyle('Aj3:As3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('AT3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
        }
        else{
            $sheet->getStyle('A3:Aj3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('f4:Aj4')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('Aj3:As3')->getAlignment()->setTextRotation(90);
            $sheet->getStyle('Aj3:As3')->getAlignment()->setTextRotation(90);
            // $sheet->getStyle('AK3:AT3')->getAlignment()->setWrapText(true);
            $sheet->getStyle('AK3:AT3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('Au3')->getAlignment()->applyFromArray(
                [
                    'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'     => TRUE
                ]
            );
            $sheet->getStyle('C')->getAlignment()->setWrapText(true);
            $sheet->getStyle('D')->getAlignment()->setWrapText(true);
            $sheet->getStyle('E')->getAlignment()->setWrapText(true);
        }
        // O si prefieres hacerlo celda por celda
        // $sheet->getStyle('A1')->getAlignment()->setTextRotation(90);
        // $sheet->getStyle('B1')->getAlignment()->setTextRotation(90);
    }
    public function columnFormats(): array
    {
        return [
            'B' => '@'  // Formato de texto para mantener los ceros a la izquierda
        ];
    }

    // Si necesitas asegurar que siempre tenga 3 dígitos
    public function map($row): array
    {
        return [
            // ... otros campos
            str_pad($row->empleado->cargo->nro_item, 3, '0', STR_PAD_LEFT),
            // ... otros campos
        ];
    }
}
