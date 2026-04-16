<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ClienteRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $clientes = Cliente::whereNull('deleted_at')->get();     
        return view('clientes.index',compact('clientes'));
    }
      
    public function create()
    {
        $cliente=new Cliente();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        //dd($deptos);
        return view('clientes.create',compact('cliente','lugares_ci'));
    }
      public function store(ClienteRequest $request)
    {
        $cliente=Cliente::create($request->all());
        $cliente->save();
        Alert::success('Registro', 'Cliente Registrado con exito!!!');
        return redirect()->route('clientes.index');
    }

    public function show($uuid)
    {
        $cliente=Cliente::where('uuid',$uuid)->firstOrFail();
        $pdf = App::make('dompdf.wrapper');
        $ciudad=Ciudad::find($cliente->ciudad_id);
        $institucion_educativa=Parametro::find($cliente->institucion_formacion_id);
        $formacion=Parametro::find($cliente->formacion_id);
        $banco=Parametro::find($cliente->banco_id);
        $seguro_salud=Parametro::find($cliente->seguro_salud_id);
      
        $profesion=Parametro::find($cliente->profesion_id);
      
        $pdf->loadView('clientes.pdf.ficha',compact('cliente','ciudad','institucion_educativa','formacion','banco','seguro_salud','profesion'));
        
        return $pdf->stream();
    }

    public function edit($uuid)
    {
        $cliente=Cliente::where('uuid',$uuid)->firstOrFail();
        $ciudades=Ciudad::all();
        $formaciones=Parametro::where('tipo','formacion')->get();
        $lugares_ci=Parametro::where('tipo','lugar_ci')->get();
        $instituciones_formacion=Parametro::where('tipo','institucion_formacion')->get();
        $tipos_cargo=Parametro::where('tipo','tipo_cargo')->get();
        $bancos=Parametro::where('tipo','banco')->get();
        $deptos=Ciudad::select('depto')->distinct()->get();
        $mod= true;
        return view('clientes.edit',compact('cliente','ciudades','formaciones','lugares_ci','instituciones_formacion','tipos_cargo','bancos','deptos','mod'));
    }

    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        Alert::success('Actualizacion', 'Datos del Cliente Actualizado con exito!!!');

        return redirect()->route('clientes.index');
    }

    public function destroy($uuid)
    {
        $cliente=Cliente::where('uuid',$uuid)->firstOrFail();
        $cliente->delete();
        Alert::success('Eliminacion', 'Cliente Eliminado con exito!!!');

        return redirect()->route('clientes.index');
    }

 
   
}
