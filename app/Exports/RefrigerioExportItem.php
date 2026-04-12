<?php 
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;  // Importar la interfaz correcta
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RefrigerioExportItem implements FromView, WithStyles
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('refrigerios.pdf.refrigerio_excel_item', $this->data);
    }



    public function styles(Worksheet $sheet)
    {
        // Centrar todo el contenido de las columnas
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center');
    

        // Recorrer todas las filas de la columna E y aplicar el estilo si el texto coincide
        foreach ($sheet->getRowIterator() as $row) {
            foreach (range('AK', 'AS') as $col) {
                $cell = $sheet->getCell($col . $row->getRowIndex());
    
                if (in_array($cell->getValue(), [
                    'DIAS HABILES' . "\n" . 'TRABAJADOS',
                    'FALTAS', 'ABANDONO', 'VACACION', 'ASUETO', 'VIATICOS',
                    'FERIADOS', 'LICENCIA CON' . "\n" . 'GOCE DE HABER',
                    'LICENCIA SIN' . "\n" . 'GOCE DE HABER'
                ])) {
                    $sheet->getStyle($col . $row->getRowIndex())->getAlignment()->setTextRotation(90);
                    $sheet->getStyle($col . $row->getRowIndex())->getAlignment()->setHorizontal('center');
                    $sheet->getStyle($col . $row->getRowIndex())->getAlignment()->setVertical('center');
                }
            }
        }
    
        // Ajustar tamaño de las columnas AK a AS
        foreach (range('AK', 'AS') as $col) {
            $sheet->getColumnDimension($col)->setWidth(15);
        }
    
        // Ajustar tamaño de la columna C
        $sheet->getColumnDimension('C')->setWidth(40);
    
        // Congelar las primeras dos columnas
        $sheet->freezePane('E1');
    }
    

}

