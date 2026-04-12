<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ConsultaRequest;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use App\Http\Requests\ReporteContraloriaConsultaRequest;

class ConsultaController extends Controller
{
     public function index()
    {
        $pacientes=null;
        return view('consultas.consulta',compact('pacientes'));
    }
    public function pacientes()
    {
        $pacientes=Paciente::with('consultas')->get();
        return view('consultas.pacientes',compact('pacientes'));
    }

    public function create($uuidPaciente)
    {
        $medicos=Medico::whereNull('deleted_at')->get();
        $paciente=Paciente::where('uuid',$uuidPaciente)->firstOrFail();
        $consultas=Consulta::where('paciente_id',$paciente->id)->get();
        return view('consultas.create',compact('paciente','consultas','medicos'));
    }

    public function store(ConsultaRequest $request)
    {
        $paciente = Paciente::find($request->paciente_id);
        $consulta = new Consulta();
        $consulta->fecha = $request->input('fecha');
        $consulta->motivo_consulta = $request->input('motivo_consulta');
        $consulta->diagnostico = $request->input('diagnostico');
        $consulta->observaciones = $request->input('observaciones');
        $consulta->paciente_id = $request->paciente_id;
        $consulta->medico_id = $request->input('medico_id');
        $consulta->save();

        Alert::success('Guardado', 'Consulta Registrada con exito!!!');
        return redirect()->route('consultas.create',$paciente->uuid);
    }
     public function edit($uuid)
    {
        $medicos=Medico::whereNull('deleted_at')->get();
        $consulta= Consulta::where('uuid',$uuid)->firstOrFail();
        $paciente = Paciente::find($consulta->paciente_id);
        return view('consultas.edit', compact('paciente', 'consulta','medicos'));
    }
    public function updated(ConsultaRequest $request, Consulta $consulta)
    {
            $paciente = Paciente::findOrFail($consulta->paciente_id);
            $consulta->fecha = $request->input('fecha');
            $consulta->motivo_consulta = $request->input('motivo_consulta');
            $consulta->diagnostico = $request->input('diagnostico');
            $consulta->observaciones = $request->input('observaciones');
            $consulta->paciente_id = $request->paciente_id;
            $consulta->medico_id = $request->input('medico_id');
            $consulta->save();
            Alert::success('Guardado', 'Consulta Actualizada con exito!!!');
            return redirect()->route('consultas.create', [$paciente->uuid])->with(compact('paciente', 'consulta'));
    }

    public function destroy($uuid)
    {
        $consulta = Consulta::where('uuid',$uuid)->firstOrFail();
        $paciente=Paciente::find($consulta->paciente_id);
        $consulta->delete();

        Alert::success('Eliminación', 'Consulta Eliminada con exito!!!');
        return redirect()->route('consultas.create',$paciente->uuid);
    }
    public function buscar_paciente(Request $request)
    {
        $nombre=$request->nombre==null ? '' : $request->nombre;
        $ci=$request->ci==null ? '' : $request->ci;
        $pacientes=DB::select("select e.*
        from pacientes e 
        where e.deleted_at is null and
        CONCAT(IFNULL(e.nombres,''),' ',IFNULL(e.ap_paterno,''),' ',IFNULL(e.ap_materno,'')) LIKE '%".$nombre."%' AND e.ci LIKE '%".$ci."%'");
        if(count($pacientes)==0){
            Alert::error('Pacientes','No existen pacientes registrados con los parámetros de búsqueda ingresados!!');
        }
        return view('consultas.consulta',compact('pacientes'));
    }
    public function reporte(){
        return view('consultas.reporte');

    }
    public function create_reporte_pdf(){
        return view('consultas.reporte_create_pdf');

    }
    public function reporte_contraloria_pdf(ReporteContraloriaConsultaRequest $request)
    {
        $tipo_trimestre=$request->input('trimestre');
        $trimestre_texto='';
        switch ($request->input('trimestre')) {
            case '1':
                $Trimestreinicio=$request->input('gestion')."-"."01"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."03"."-"."31";
                $trimestre_texto='I';
                break;
            case '2':
                $Trimestreinicio=$request->input('gestion')."-"."04"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."06"."-"."30";
                $trimestre_texto='II';
                break;
            case '3':
                $Trimestreinicio=$request->input('gestion')."-"."07"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."09"."-"."30";
                $trimestre_texto='III';
                break;
            case '4':
                $Trimestreinicio=$request->input('gestion')."-"."10"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."12"."-"."31";
                $trimestre_texto='IV';
                break;  
        }
        $pdf = App::make('dompdf.wrapper');

        $tipo_declaracion=$request->input('tipo');
        
        if($request->input('tipo') == 2){
            $trimestre = $request->input('trimestre');

            // Definir los meses correspondientes a cada trimestre
            $trimestres = [
                1 => [1, 2, 3],  // Enero - Marzo
                2 => [4, 5, 6],  // Abril - Junio
                3 => [7, 8, 9],  // Julio - Septiembre
                4 => [10, 11, 12] // Octubre - Diciembre
            ];

            $consultas = null;
        }else{
            $consultas = null;       
        }
        
        
        if(count($consultas)>0 ){
            $pdf->loadView('consultas.pdf.reporte_contraloria_pdf',compact('consultas','tipo_declaracion','tipo_trimestre'));
            $pdf->setPaper('letter', 'landscape');
            $titulo="Reporte DDJJ del ".$trimestre_texto.' trimestre de la gestión '.$request->gestion.' al '.date('d-m-Y');
            return $pdf->download(Str::ascii($titulo).'.pdf');
        }
        else{
            Alert::success('Reportes Contraloria','No existen consultas juradas de acuerdo a las variables ingresadas!!');
            return redirect()->route('consultas.pdf');
        }
    }
    public function reporte_contraloria_excel(ReporteContraloriaConsultaRequest $request){
        $tipo_trimestre=$request->input('trimestre');
        $trimestre_texto='';
        switch ($request->input('trimestre')) {
            case '1':
                $Trimestreinicio=$request->input('gestion')."-"."01"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."03"."-"."31";
                $trimestre_texto='I';
                break;
            case '2':

                $Trimestreinicio=$request->input('gestion')."-"."04"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."06"."-"."30";
                $trimestre_texto='II';
                break;

            case '3':
                $Trimestreinicio=$request->input('gestion')."-"."07"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."09"."-"."30";
                $trimestre_texto='III';
                break;
            case '4':
                $Trimestreinicio=$request->input('gestion')."-"."10"."-"."01";
                $Trimestrefin=$request->input('gestion')."-"."12"."-"."31";
                $trimestre_texto='IV';
                break;  
        }
        $tipo_declaracion=$request->input('tipo');
        $consultas=DeclaracionJurada::where('tipo',$request->input('tipo'))->whereBetween('fecha_certificacion', [$Trimestreinicio,$Trimestrefin])->get();
        if(count($consultas)>0 || $request->input('tipo') == 2){
            $titulo="Reporte DDJJ del ".$trimestre_texto.' trimestre de la gestión '.$request->gestion.' al '.date('d-m-Y');
            return Excel::download(new DeclaracionJuradaExport($request),$titulo.'.xlsx');
        }
        else{
            Alert::success('Reportes Contraloria','No existen consultas juradas de acuerdo a las variables ingresadas!!');
            return redirect()->route('consultas.pdf');
        }
    }
    public  function create_reporte_excel(){
        return view ('consultas.reporte_create_excel');
    }
}