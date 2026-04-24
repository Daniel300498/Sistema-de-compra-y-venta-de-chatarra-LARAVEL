<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\OperadorTransporte;
use App\Http\Requests\ContratoRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contratos  = Contrato::with(['cliente', 'proveedor'])
                        ->whereNull('deleted_at')
                        ->orderByDesc('created_at')
                        ->get();

        $clientes   = Cliente::whereNull('deleted_at')->orderBy('nombre')->get();

        $proveedores = Proveedor::whereNull('deleted_at')
                        ->orderBy('nombre')
                        ->get();

        $numeroSiguiente = Contrato::generarNumero();

        return view('contratos.index', compact('contratos', 'clientes', 'proveedores', 'numeroSiguiente'));
    }

    public function store(ContratoRequest $request)
    {
        $data = $request->except('documento_pdf');

        if ($request->hasFile('documento_pdf')) {
            $data['documento_pdf'] = $request->file('documento_pdf')
                ->store('contratos', 'public');
        }

        Contrato::create($data);
        Alert::success('Registro', 'Contrato registrado con éxito.');
        return redirect()->route('contratos.index');
    }

    public function edit($uuid)
    {
        $contrato = Contrato::with(['cliente', 'proveedor'])
                        ->where('uuid', $uuid)->firstOrFail();
        return response()->json($contrato);
    }

    public function update(ContratoRequest $request, Contrato $contrato)
    {
        $data = $request->except('documento_pdf');

        if ($request->hasFile('documento_pdf')) {
            // Eliminar el PDF anterior si existe
            if ($contrato->documento_pdf) {
                Storage::disk('public')->delete($contrato->documento_pdf);
            }
            $data['documento_pdf'] = $request->file('documento_pdf')
                ->store('contratos', 'public');
        }

        $contrato->update($data);
        Alert::success('Actualización', 'Contrato actualizado con éxito.');
        return redirect()->route('contratos.index');
    }

    public function verPdf($uuid)
    {
        $contrato = Contrato::where('uuid', $uuid)->firstOrFail();

        abort_if(!$contrato->documento_pdf, 404, 'Este contrato no tiene documento PDF.');

        $path = Storage::disk('public')->path($contrato->documento_pdf);

        abort_if(!file_exists($path), 404, 'Archivo no encontrado.');

        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }

    public function destroy($uuid)
    {
        $contrato = Contrato::where('uuid', $uuid)->firstOrFail();
        $contrato->delete();
        Alert::success('Eliminación', 'Contrato eliminado con éxito.');
        return redirect()->route('contratos.index');
    }

    public function camiones($uuid)
    {
        $contrato = Contrato::with([
            'cliente',
            'proveedor',
            'contratoCamiones.camion.conductorActual.conductor',
            'contratoCamiones.conductor',
        ])->where('uuid', $uuid)->firstOrFail();

        $camionesDisponibles = Camion::with(['conductorActual.conductor'])
            ->whereNull('deleted_at')
            ->where('estado', 'Activo')
            ->orderBy('placa')
            ->get();

        $choferes = OperadorTransporte::whereNull('deleted_at')
            ->whereIn('tipo_operador', ['chofer', 'ambos'])
            ->whereNotNull('licencia_numero')
            ->orderBy('nombre')
            ->get();

        return view('contratos.camiones', compact('contrato', 'camionesDisponibles', 'choferes'));
    }
}
