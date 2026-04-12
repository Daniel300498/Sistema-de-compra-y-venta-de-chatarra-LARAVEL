<?php 
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;  // Importar la interfaz correcta
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RefrigerioExport implements FromView, WithStyles
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('refrigerios.pdf.refrigerio_excel', $this->data);
    }



    public function styles(Worksheet $sheet)
    {
        // Centrar todo el contenido de las columnas
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center');
    
        // Definir colores alternativos para los grupos
        $colores = ['FFD966', 'C6E0B4', 'D9E1F2', 'F4B084']; // Amarillo, verde, azul, naranja
        $colorIndex = 0; // ª¿ndice para alternar colores
    
        $lugarAnterior = null; // Para rastrear el cambio de grupo
    
        // Definir el color morado para la "S"
        $morado = '800080';
    
        // Iterar sobre todas las filas a partir de la segunda (asumiendo que la primera es encabezado)
        foreach ($sheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex(); // N«âmero de fila en el Excel
            $lugarTrabajo = $sheet->getCell('F' . $rowIndex)->getValue(); // Ajusta la columna 'F' si la ubicaci«Ñn es diferente
    
            // Si cambia el lugar de trabajo, cambia el color
            if ($lugarTrabajo !== $lugarAnterior) {
                $colorIndex = ($colorIndex + 1) % count($colores); // Alternar entre colores
                $lugarAnterior = $lugarTrabajo;
            }
    
            // Aplicar color de fondo a toda la fila
            $fondoFila = $colores[$colorIndex]; // Color seg«ân el grupo
            foreach (range('B', 'Z') as $col) { // Ajusta 'Z' al «âltimo rango de tu Excel
                $cell = $sheet->getCell($col . $rowIndex);
                if ($cell->getValue() === 'S') {
                    // Si la celda tiene "S", pintarla de morado
                    $sheet->getStyle($col . $rowIndex)
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB($morado);
                } else {
                    // Aplicar el color de la fila si no tiene "S"
                    $sheet->getStyle($col . $rowIndex)
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB($fondoFila);
                }
            }
        }
    
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
    
        // Ajustar tama«Ðo de las columnas AK a AS
        foreach (range('AK', 'AS') as $col) {
            $sheet->getColumnDimension($col)->setWidth(15);
        }
    
        // Ajustar tama«Ðo de la columna C
        $sheet->getColumnDimension('C')->setWidth(40);
    
        // Congelar las primeras dos columnas
        $sheet->freezePane('E1');
    }
    

}


