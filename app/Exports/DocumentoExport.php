<?php 
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;  // Importar la interfaz correcta
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DocumentoExport implements FromView
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('documentacion.reporte_excel', $this->data);
    }

}

