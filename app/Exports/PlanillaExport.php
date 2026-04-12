<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PlanillaExport implements FromView, ShouldAutoSize
{
    protected $datos_planilla;
    public function __construct($datos_planilla)
    {
        $this->datos_planilla = $datos_planilla;
        
    }
 
    public function view(): View
    {
        return view('planillas.xls.planilla_mensual',['datos' => $this->datos_planilla]);
    }
}
