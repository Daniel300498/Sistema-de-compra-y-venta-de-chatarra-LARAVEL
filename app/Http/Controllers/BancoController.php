<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\CuentaBancaria;
use App\Models\Proveedor;
use App\Models\OperadorTransporte;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BancoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bancos      = Banco::withCount('cuentas')->whereNull('deleted_at')->orderBy('pais')->orderBy('nombre')->get();
        $proveedores = Proveedor::whereNull('deleted_at')->orderBy('nombre')->get();
        $operadores  = OperadorTransporte::whereNull('deleted_at')->orderBy('nombre')->get();

        return view('bancos.index', compact('bancos', 'proveedores', 'operadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150',
            'pais'         => 'required|string|max:100',
            'codigo_swift' => 'nullable|string|max:20',
        ], [
            'nombre.required' => 'El nombre del banco es obligatorio.',
            'pais.required'   => 'El país del banco es obligatorio.',
        ]);

        Banco::create([
            'nombre'       => strtoupper($request->nombre),
            'pais'         => $request->pais,
            'codigo_swift' => $request->codigo_swift ? strtoupper($request->codigo_swift) : null,
            'activo'       => true,
            'created_by'   => auth()->id(),
            'updated_by'   => auth()->id(),
        ]);

        Alert::success('Éxito', 'Banco registrado correctamente.');
        return redirect()->route('bancos.index');
    }

    public function update(Request $request, $uuid)
    {
        $banco = Banco::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nombre'       => 'required|string|max:150',
            'pais'         => 'required|string|max:100',
            'codigo_swift' => 'nullable|string|max:20',
        ]);

        $banco->update([
            'nombre'       => strtoupper($request->nombre),
            'pais'         => $request->pais,
            'codigo_swift' => $request->codigo_swift ? strtoupper($request->codigo_swift) : null,
            'updated_by'   => auth()->id(),
        ]);

        Alert::success('Éxito', 'Banco actualizado correctamente.');
        return redirect()->route('bancos.index');
    }

    public function destroy($uuid)
    {
        $banco = Banco::where('uuid', $uuid)->firstOrFail();

        if ($banco->cuentas()->whereNull('deleted_at')->exists()) {
            Alert::error('No permitido', 'No se puede eliminar un banco que tiene cuentas registradas.');
            return redirect()->route('bancos.index');
        }

        $banco->delete();
        Alert::success('Éxito', 'Banco eliminado.');
        return redirect()->route('bancos.index');
    }

    // Cuentas bancarias
    public function storeCuenta(Request $request)
    {
        $request->validate([
            'banco_id'      => 'required|exists:bancos,id',
            'tipo_titular'  => 'required|in:empresa,proveedor,operador',
            'titular_id'    => 'nullable|integer',
            'numero_cuenta' => 'required|string|max:100',
            'moneda'        => 'required|string|max:10',
            'alias'         => 'nullable|string|max:150',
        ], [
            'banco_id.required'      => 'Debe seleccionar un banco.',
            'tipo_titular.required'  => 'Debe indicar el tipo de titular.',
            'numero_cuenta.required' => 'El número de cuenta es obligatorio.',
            'moneda.required'        => 'La moneda es obligatoria.',
        ]);

        $titularType = match($request->tipo_titular) {
            'proveedor' => 'App\Models\Proveedor',
            'operador'  => 'App\Models\OperadorTransporte',
            default     => null,
        };

        CuentaBancaria::create([
            'banco_id'      => $request->banco_id,
            'tipo_titular'  => $request->tipo_titular,
            'titular_id'    => in_array($request->tipo_titular, ['proveedor', 'operador']) ? $request->titular_id : null,
            'titular_type'  => $titularType,
            'numero_cuenta' => $request->numero_cuenta,
            'moneda'        => $request->moneda,
            'alias'         => $request->alias,
            'activo'        => true,
            'created_by'    => auth()->id(),
            'updated_by'    => auth()->id(),
        ]);

        Alert::success('Éxito', 'Cuenta bancaria registrada correctamente.');
        return redirect()->route('bancos.index');
    }

    public function destroyCuenta($uuid)
    {
        $cuenta = CuentaBancaria::where('uuid', $uuid)->firstOrFail();
        $cuenta->delete();
        Alert::success('Éxito', 'Cuenta bancaria eliminada.');
        return redirect()->route('bancos.index');
    }
}
