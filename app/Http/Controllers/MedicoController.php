<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Medico;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Requests\MedicoRequest;
use RealRashid\SweetAlert\Facades\Alert;

class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $medicos = Medico::whereNull('deleted_at')->get();     
        return view('medicos.index',compact('medicos'));
    }
      
    public function create()
    {
        $medico=new Medico();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        //dd($deptos);
        return view('medicos.create',compact('medico','lugares_ci'));
    }
      public function store(MedicoRequest $request)
    {
        $medico=Medico::create($request->all());
        $medico->save();
        Alert::success('Registro', 'Medico Registrado con exito!!!');
        return redirect()->route('medicos.index');
    }

    public function show($uuid)
    {
        $medico=Medico::where('uuid',$uuid)->firstOrFail();
        $pdf = App::make('dompdf.wrapper');
        $ciudad=Ciudad::find($medico->ciudad_id);
        $institucion_educativa=Parametro::find($medico->institucion_formacion_id);
        $formacion=Parametro::find($medico->formacion_id);
        $banco=Parametro::find($medico->banco_id);
        $seguro_salud=Parametro::find($medico->seguro_salud_id);
      
        $profesion=Parametro::find($medico->profesion_id);
      
        $pdf->loadView('medicos.pdf.ficha',compact('medico','ciudad','institucion_educativa','formacion','banco','seguro_salud','profesion'));
        
        return $pdf->stream();
    }

    public function edit($uuid)
    {
        $medico=Medico::where('uuid',$uuid)->firstOrFail();
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $deptos=Ciudad::select('depto')->distinct()->get();
        $mod= true;
        return view('medicos.edit',compact('medico','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','bancos','deptos','mod'));
    }

    public function update(MedicoRequest $request, Medico $medico)
    {
        $medico->update($request->all());
        Alert::success('Actualizacion', 'Datos del Medico Actualizado con exito!!!');

        return redirect()->route('medicos.index');
    }

    public function destroy($uuid)
    {
        $medico=Medico::where('uuid',$uuid)->firstOrFail();
        $medico->delete();
        Alert::success('Eliminacion', 'Medico Eliminado con exito!!!');

        return redirect()->route('medicos.index');
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
