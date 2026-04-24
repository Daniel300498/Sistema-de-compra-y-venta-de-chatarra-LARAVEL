<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\CamionConductor;
use App\Models\CamionFoto;
use App\Models\OperadorTransporte;
use App\Http\Requests\CamionRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CamionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $camiones   = Camion::with(['propietario', 'conductorActual.conductor', 'fotos'])
                            ->whereNull('deleted_at')->get();
        $operadores = OperadorTransporte::whereNull('deleted_at')->orderBy('nombre')->get();
        $choferes   = OperadorTransporte::whereNull('deleted_at')
                            ->whereIn('tipo_operador', ['chofer', 'ambos'])
                            ->whereNotNull('licencia_numero')
                            ->orderBy('nombre')->get();
        $asignaciones = CamionConductor::with(['camion', 'conductor'])
                            ->orderByDesc('fecha_inicio')->get();

        return view('camiones.index', compact('camiones', 'operadores', 'choferes', 'asignaciones'));
    }

    public function store(CamionRequest $request)
    {
        $data = $request->except(['documento_ruat', 'fotos']);

        if ($request->hasFile('documento_ruat')) {
            $data['documento_ruat'] = $request->file('documento_ruat')
                ->store('camiones/ruat', 'public');
        }

        $camion = Camion::create($data);

        if ($request->hasFile('fotos')) {
            $fotos = is_array($request->file('fotos')) ? $request->file('fotos') : [$request->file('fotos')];
            foreach ($fotos as $foto) {
                $ruta = $foto->store('camiones/fotos', 'public');
                CamionFoto::create(['camion_id' => $camion->id, 'ruta' => $ruta]);
            }
        }

        Alert::success('Registro', 'Camión registrado con éxito.');
        return redirect()->route('camiones.index');
    }

    public function edit($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();
        return response()->json($camion);
    }

    public function update(CamionRequest $request, Camion $camion)
    {
        $data = $request->except(['documento_ruat', 'fotos']);

        if ($request->hasFile('documento_ruat')) {
            if ($camion->documento_ruat) {
                Storage::disk('public')->delete($camion->documento_ruat);
            }
            $data['documento_ruat'] = $request->file('documento_ruat')
                ->store('camiones/ruat', 'public');
        }

        $camion->update($data);

        if ($request->hasFile('fotos')) {
            $totalActual = $camion->fotos()->count();
            $nuevas      = $request->file('fotos');
            $nuevas      = is_array($nuevas) ? $nuevas : [$nuevas];
            $disponibles = max(0, 5 - $totalActual);

            foreach (array_slice($nuevas, 0, $disponibles) as $foto) {
                $ruta = $foto->store('camiones/fotos', 'public');
                CamionFoto::create(['camion_id' => $camion->id, 'ruta' => $ruta]);
            }
        }

        Alert::success('Actualización', 'Datos del camión actualizados con éxito.');
        return redirect()->route('camiones.index');
    }

    public function verRuat($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();
        abort_if(!$camion->documento_ruat, 404, 'Este camión no tiene RUAT cargado.');
        $path = Storage::disk('public')->path($camion->documento_ruat);
        abort_if(!file_exists($path), 404, 'Archivo no encontrado.');
        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }

    public function eliminarFoto(CamionFoto $foto)
    {
        Storage::disk('public')->delete($foto->ruta);
        $foto->delete();
        return response()->json(['ok' => true]);
    }

    public function destroy($uuid)
    {
        $camion = Camion::where('uuid', $uuid)->firstOrFail();
        $camion->delete();
        Alert::success('Eliminación', 'Camión eliminado con éxito.');
        return redirect()->route('camiones.index');
    }
}
