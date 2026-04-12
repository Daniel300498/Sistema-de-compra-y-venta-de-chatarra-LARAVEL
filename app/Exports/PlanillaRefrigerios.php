<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PlanillaRefrigerios implements FromView, ShouldAutoSize
{
    protected $datos_planilla, $diasDelMes;
    public function __construct($datos_planilla,$diasDelMes)
    {
        $this->datos_planilla = $datos_planilla;
        $this->diasDelMes = $diasDelMes;
    }
 
    public function view(): View
    {
        return view('planillas.xls.planilla_refrigerios',['reporteMensual' => $this->datos_planilla,'diasEnMes' => $this->diasDelMes]);
    }
}
