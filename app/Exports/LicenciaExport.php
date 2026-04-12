<?php
 namespace App\Exports;

use App\Models\Area;
use App\Models\DeclaracionJurada;
use App\Models\Lactancia;
use App\Models\LactanciaMensual;
use App\Models\Licencia;
use App\Models\Parametro;
use App\Models\Vacacion;
 use Carbon\Carbon;
 use Illuminate\Contracts\View\View;
 use Illuminate\Http\Request;
 use Maatwebsite\Excel\Concerns\FromView;
 use Maatwebsite\Excel\Concerns\ShouldAutoSize;
 class LicenciaExport implements FromView, ShouldAutoSize
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }
 
    public function view(): View
    {
        $lugar_trabajo_busqueda = json_decode($this->request->lugar_trabajo_busqueda);
        $area_busqueda = json_decode($this->request->area_busqueda);
        $tipo_licencia_busqueda = json_decode($this->request->tipo_licencia_busqueda);
        $doc_area = $this->request->doc_area;
        $doc_lugar_trabajo = $this->request->doc_lugar_trabajo;
        $doc_tipo_licencia = $this->request->doc_tipo_licencia;
        $fecha_desde = $this->request->fecha_desde;
        $fecha_hasta = $this->request->fecha_hasta;
        $info_empleado = $this->request->info_empleado;
      
        return view('licencias.pdf.reporte_excel',compact('info_empleado','doc_area','doc_lugar_trabajo','doc_tipo_licencia','lugar_trabajo_busqueda','area_busqueda','tipo_licencia_busqueda','fecha_desde','fecha_hasta'));
                
            
    }
}