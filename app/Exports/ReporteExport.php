<?php
 namespace App\Exports;
 
 use App\Models\DeclaracionJurada;
 use App\Models\Licencia;
 use App\Models\Vacacion;
 use Illuminate\Contracts\View\View;
 use Illuminate\Http\Request;
 use Maatwebsite\Excel\Concerns\FromView;
 use Maatwebsite\Excel\Concerns\ShouldAutoSize;
 class ReporteExport implements FromView, ShouldAutoSize
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }
 
    public function view(): View
    {

        $tipo = $this->request->tipo_reporte;
        $titulo = $this->request->titulo;
        switch ($this->request->input('tipo_reporte')) {
            case '1':
                $vacaciones = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('vacaciones', 'tipo', 'titulo'));
            case '2':
                $licencia = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('licencia', 'tipo', 'titulo'));
            case '3':
                $licencia = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('licencia', 'tipo', 'titulo'));
            case '4':
                $licencia = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('licencia', 'tipo', 'titulo'));
            case '5':
                $licencia = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('licencia', 'tipo', 'titulo'));
            case '6':
                $empleado = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('empleado', 'tipo', 'titulo'));
            case '8':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '9':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '10':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '11':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '12':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '13':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
            case '14':
                $variable = unserialize(base64_decode($this->request->variable));
                return view('reportes.pdf.reporte_excel', compact('variable', 'tipo', 'titulo'));
        }
    }
}