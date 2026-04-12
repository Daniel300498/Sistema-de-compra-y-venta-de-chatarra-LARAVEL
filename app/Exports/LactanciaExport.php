<?php
 namespace App\Exports;
 
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
 class LactanciaExport implements FromView, ShouldAutoSize
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }
 
    public function view(): View
    {
        $licencia_prenatal = Parametro::where('tipo','tipo_lactancia')->where('descripcion','PRENATAL')->first();
        $licencia_postnatal = Parametro::where('tipo','tipo_lactancia')->where('descripcion','POSTNATAL')->first();
        $bono_lactancia = Parametro::where('tipo','lactancia_bono_monto')->first();
        //$today = new Carbon($this->$request->fecha_desde);
        $fecha_inicio = (new Carbon($this->request->fecha_desde))->format('Y-m-01');
        $fecha_fin = ((new Carbon($fecha_inicio))->addMonth()->subDay())->format('Y-m-d');

        $meses = ['ENERO', 'FEBRERO', 'MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
        $mes_inicio = $meses[((new Carbon($fecha_inicio))->month)-1];
        if($mes_inicio){
            $mes = $mes_inicio;
        }

    
        $lactancias = Lactancia::with(['mensual','empleado','beneficiaria_lactancia','matricula_lactancia'])
        ->whereHas('mensual', function($query) use ($fecha_inicio, $fecha_fin) {
            $query->whereBetween('fecha_firma', [$fecha_inicio,$fecha_fin]);
            $query->where('estado','=','SI');
        })->orWhere(function ($query) use ($fecha_inicio, $fecha_fin) {
            $query->whereDate('fecha_inicio_postnatal','<=',$fecha_fin);
            $query->whereDate('fecha_fin_postnatal','>=',$fecha_inicio);
        })
        ->get();

        return view('lactancia.pdf.reporte_excel',compact('lactancias','mes','fecha_inicio','fecha_fin','licencia_prenatal','licencia_postnatal','bono_lactancia'));
                
            
    }
}