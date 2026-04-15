<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Proveedor;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ProveedorRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {      
        $proveedores = Proveedor::whereNull('deleted_at')->get();     
        return view('proveedores.index',compact('proveedores'));
    }
      
    public function create()
    {
        $proveedor=new Proveedor();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        //dd($deptos);
        return view('proveedores.create',compact('proveedor','lugares_ci'));
    }
      public function store(ProveedorRequest $request)
    {
        $proveedor=Proveedor::create($request->all());
        $proveedor->save();
        Alert::success('Registro', 'proveedor Registrado con exito!!!');
        return redirect()->route('proveedores.index');
    }

    public function show($uuid)
    {
        $proveedor=Proveedor::where('uuid',$uuid)->firstOrFail();
        $pdf = App::make('dompdf.wrapper');
        $ciudad=Ciudad::find($proveedor->ciudad_id);
        $institucion_educativa=Parametro::find($proveedor->institucion_formacion_id);
        $formacion=Parametro::find($proveedor->formacion_id);
        $banco=Parametro::find($proveedor->banco_id);
        $seguro_salud=Parametro::find($proveedor->seguro_salud_id);
      
        $profesion=Parametro::find($proveedor->profesion_id);
      
        $pdf->loadView('proveedores.pdf.ficha',compact('proveedor','ciudad','institucion_educativa','formacion','banco','seguro_salud','profesion'));
        
        return $pdf->stream();
    }

    public function edit($uuid)
    {
        $proveedor=Proveedor::where('uuid',$uuid)->firstOrFail();
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $deptos=Ciudad::select('depto')->distinct()->get();
        $mod= true;
        return view('proveedores.edit',compact('proveedor','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','bancos','deptos','mod'));
    }

    public function update(proveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->update($request->all());
        Alert::success('Actualizacion', 'Datos del proveedor Actualizado con exito!!!');

        return redirect()->route('proveedores.index');
    }


    public function destroy($uuid)
    {
        $proveedor=Proveedor::where('uuid',$uuid)->firstOrFail();
        $proveedor->delete();
        Alert::success('Eliminacion', 'proveedor Eliminado con exito!!!');

        return redirect()->route('proveedores.index');
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
