<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Internacion;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Cama;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\DeclaracionJuradaExport;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\InternacionRequest;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use App\Http\Requests\ReporteContraloriaConsultaRequest;

class InternacionController extends Controller
{
     public function index()
    {
        $pacientes=null;
        return view('internaciones.internacion',compact('pacientes'));
    }
    public function pacientes()
    {
        $pacientes=Paciente::with('internaciones')->get();
        return view('internaciones.pacientes',compact('pacientes'));
    }

    public function create($uuidPaciente)
    {
        $medicos=Medico::all();
        $camas=Cama::where('estado', 'DESOCUPADO')->get();
        $paciente=Paciente::where('uuid',$uuidPaciente)->firstOrFail();
        $internaciones=Internacion::where('paciente_id',$paciente->id)->get();
        return view('internaciones.create',compact('paciente','internaciones','medicos','camas'));
    }

    public function store(InternacionRequest $request)
    {
        $paciente = Paciente::find($request->paciente_id);
        $internacion = new Internacion();
        $internacion->paciente_id = $request->paciente_id;
        $internacion->cama_id = $request->cama_id;
        $internacion->medico_id = $request->medico_id;
        $internacion->fecha_ocupacion = $request->input('fecha_ocupacion');
        $internacion->fecha_desocupacion = $request->input('fecha_desocupacion');
        $internacion->motivo = $request->input('motivo');
        $internacion->observaciones = $request->input('observaciones');
        $internacion->nombre_cobertura = $request->input('nombre_cobertura'); 
        $internacion->tipo_cobertura = $request->input('tipo_cobertura');
        $internacion->save();

        Alert::success('Guardado', 'Datos de Internacion Guardada con exito!!!');
        return redirect()->route('internaciones.create',$paciente->uuid);
    }
     public function edit($uuid)
    {
        $medicos=Medico::all();
        $camas=Cama::all();
        $internacion= Internacion::where('uuid',$uuid)->firstOrFail();
        $paciente = Paciente::find($internacion->paciente_id);
        return view('internaciones.edit', compact('paciente', 'internacion', 'medicos','camas'));
    }
    public function updated(InternacionRequest $request, Internacion $internacion)
    {
        $paciente = Paciente::findOrFail($internacion->paciente_id);
        $internacion->paciente_id = $request->paciente_id;
        $internacion->cama_id = $request->cama_id;
        $internacion->medico_id = $request->medico_id;
        $internacion->fecha_ocupacion = $request->input('fecha_ocupacion');
        $internacion->fecha_desocupacion = $request->input('fecha_desocupacion');
        $internacion->motivo = $request->input('motivo');
        $internacion->observaciones = $request->input('observaciones');
        $internacion->nombre_cobertura = $request->input('nombre_cobertura'); 
        $internacion->tipo_cobertura = $request->input('tipo_cobertura');
        $internacion->save();
    
         Alert::success('Guardado', 'Datos de Internacion Actualizado con exito!!!');
        return redirect()->route('internaciones.create', [$paciente->uuid])->with(compact('paciente', 'internacion'));

    }

    public function destroy($uuid)
    {
        $internacion = Internacion::where('uuid',$uuid)->firstOrFail();
        $paciente=Paciente::find($internacion->paciente_id);
        $internacion->delete();

        Alert::success('Eliminación', 'Registro de internacion Eliminada con exito!!!');
        return redirect()->route('internaciones.create',$paciente->uuid);
    }
    public function buscar_paciente_internacion(Request $request)
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
        return view('internaciones.internacion',compact('pacientes'));
    }
    public function reporte(){
        return view('internaciones.reporte');

    }
    public function create_reporte_pdf(){
        return view('internaciones.reporte_create_pdf');

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

            $internaciones = null;
        }else{
            $internaciones = null;       
        }
        
        
        if(count($internaciones)>0 ){
            $pdf->loadView('internaciones.pdf.reporte_contraloria_pdf',compact('internaciones','tipo_declaracion','tipo_trimestre'));
            $pdf->setPaper('letter', 'landscape');
            $titulo="Reporte DDJJ del ".$trimestre_texto.' trimestre de la gestión '.$request->gestion.' al '.date('d-m-Y');
            return $pdf->download(Str::ascii($titulo).'.pdf');
        }
        else{
            Alert::success('Reportes Contraloria','No existen internaciones juradas de acuerdo a las variables ingresadas!!');
            return redirect()->route('internaciones.pdf');
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
        $internaciones=DeclaracionJurada::where('tipo',$request->input('tipo'))->whereBetween('fecha_certificacion', [$Trimestreinicio,$Trimestrefin])->get();
        if(count($internaciones)>0 || $request->input('tipo') == 2){
            $titulo="Reporte DDJJ del ".$trimestre_texto.' trimestre de la gestión '.$request->gestion.' al '.date('d-m-Y');
            return Excel::download(new DeclaracionJuradaExport($request),$titulo.'.xlsx');
        }
        else{
            Alert::success('Reportes Contraloria','No existen internaciones juradas de acuerdo a las variables ingresadas!!');
            return redirect()->route('internaciones.pdf');
        }
    }
    public  function create_reporte_excel(){
        return view ('internaciones.reporte_create_excel');
    }
}