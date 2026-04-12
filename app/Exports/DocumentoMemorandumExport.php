<?php
 namespace App\Exports;


 use Carbon\Carbon;
 use Illuminate\Contracts\View\View;
 use Illuminate\Http\Request;
 use Maatwebsite\Excel\Concerns\FromView;
 use Maatwebsite\Excel\Concerns\ShouldAutoSize;
 class DocumentoMemorandumExport implements FromView, ShouldAutoSize
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }
 
    public function view(): View
    {
        $fecha_desde = $this->request->fecha_desde;
        $fecha_hasta = $this->request->fecha_hasta;
        $info_empleado = $this->request->info_empleado;
      
        return view('documentoMemorandum.pdf.reporte_excel',compact('info_empleado','fecha_desde','fecha_hasta'));
                
            
    }
}