<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Paciente;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PacienteRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $pacientes = Paciente::whereNull('deleted_at')->get();     
        return view('pacientes.index',compact('pacientes'));
    }
      
    public function create()
    {
        $paciente=new Paciente();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        //dd($deptos);
        return view('pacientes.create',compact('paciente','lugares_ci'));
    }
      public function store(PacienteRequest $request)
    {
        $paciente=Paciente::create($request->all());
        $paciente->save();
        Alert::success('Registro', 'Paciente Registrado con exito!!!');
        return redirect()->route('pacientes.index');
    }

    public function show($uuid)
    {
        $paciente=Paciente::where('uuid',$uuid)->firstOrFail();
        $pdf = App::make('dompdf.wrapper');
        $ciudad=Ciudad::find($paciente->ciudad_id);
        $institucion_educativa=Parametro::find($paciente->institucion_formacion_id);
        $formacion=Parametro::find($paciente->formacion_id);
        $banco=Parametro::find($paciente->banco_id);
        $seguro_salud=Parametro::find($paciente->seguro_salud_id);
      
        $profesion=Parametro::find($paciente->profesion_id);
      
        $pdf->loadView('pacientes.pdf.ficha',compact('paciente','ciudad','institucion_educativa','formacion','banco','seguro_salud','profesion'));
        
        return $pdf->stream();
    }

    public function edit($uuid)
    {
        $paciente=Paciente::where('uuid',$uuid)->firstOrFail();
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $deptos=Ciudad::select('depto')->distinct()->get();
        $mod= true;
        return view('pacientes.edit',compact('paciente','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','bancos','deptos','mod'));
    }

    public function update(PacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        Alert::success('Actualizacion', 'Datos del Paciente Actualizado con exito!!!');

        return redirect()->route('pacientes.index');
    }

    public function destroy($uuid)
    {
        $paciente=Paciente::where('uuid',$uuid)->firstOrFail();
        $paciente->delete();
        Alert::success('Eliminacion', 'Paciente Eliminado con exito!!!');

        return redirect()->route('pacientes.index');
    }

    public function tipo_parentesco(Request $request)
    {
        $search = $request->search;
        
        $nombres = DB::table('empleados')->select('contacto_parentesco')->where('contacto_parentesco', 'like', '%' .$search . '%' )->limit(5)->distinct('contacto_parentesco')->get();
        $response = array();
        foreach($nombres as $codigo){
            $response[] = array("value"=>$codigo->contacto_parentesco);
        }
        return response()->json($response);
    }
 
   
}
