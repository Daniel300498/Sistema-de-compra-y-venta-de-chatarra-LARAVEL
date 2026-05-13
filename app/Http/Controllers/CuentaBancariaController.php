<?php

namespace App\Http\Controllers;
use App\Models\CuentaBancaria;
use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Http\Requests\CuentaBancariaRequest;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class CuentaBancariaController extends Controller
{
    public function index()
    {
        $bancos= Parametro::where('tipo','bancos')->get();
        $cuentas_bancarias=CuentaBancaria::whereNull('deleted_at')->orderBy('created_at','desc')->get();
        return view('cuentas_bancarias.index',compact('bancos','cuentas_bancarias'));
    }
    public function store(CuentaBancariaRequest $request)
    {
        $numeroCuenta = preg_replace('/\s+/', '', $request->numero_cuenta);
        $cuenta_bancaria = new CuentaBancaria();
        $cuenta_bancaria->banco = $request->input('banco');
        $cuenta_bancaria->alias = $request->input('alias');
        $cuenta_bancaria->numero_cuenta= $request->input('numero_cuenta');
        $cuenta_bancaria->numero_cuenta_ultimos = substr($numeroCuenta, -4);
        $cuenta_bancaria->titular = $request->input('titular');
        $cuenta_bancaria->activa = $request->has('activa');
        $cuenta_bancaria->descripcion = $request->input('descripcion');
        $cuenta_bancaria->save();
           
        Alert::success('Registrado', 'Cuenta Bancaria Registrada con exito!!!');
        return redirect()->route('cuentas_bancarias.index');       
    }
    public function show($id)
    {
        return CuentaBancaria::findOrFail($id);
    }
    public function update(CuentaBancariaRequest $request, CuentaBancaria $cuenta_bancaria)
    {
        $cuenta_bancaria->banco = $request->input('banco');
        $cuenta_bancaria->numero_cuenta= $request->input('numero_cuenta');
        $cuenta_bancaria->alias = $request->input('alias');
        $cuenta_bancaria->numero_cuenta_ultimos = substr($request->input('numero_cuenta'), -4);
        $cuenta_bancaria->titular = $request->input('titular');
        $cuenta_bancaria->activa = $request->has('activa');
        $cuenta_bancaria->descripcion = $request->input('descripcion');
        $cuenta_bancaria->save();
        Alert::success('Actualizacion', 'Cuenta Bancaria Actualizada con exito!!!');
        return redirect()->route('cuentas_bancarias.index');   
    }
    public function destroy($uuid)
    {
        $cuenta = CuentaBancaria::where('uuid',$uuid)->firstOrFail();
        $cuenta->delete();
        Alert::success('Eliminacion', 'Cuenta Bancaria eliminada con exito!!!');
        return redirect()->route('cuentas_bancarias.index');       }
}