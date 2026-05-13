<?php

namespace App\Http\Controllers;

use App\Models\GastoExtra;
use App\Models\Contrato;
use App\Http\Requests\GastoExtraRequest;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class GastoExtraController extends Controller
{
    public function index()
    {
        $contratos=Contrato::whereNull('deleted_at')->get();
        $gastos=GastoExtra::all();
        $cuentas_banco=CuentaBancaria::where('activa',true)->get();
        $total=GastoExtra::where('estado','pagado')->sum('monto_bolivianos');
        $aduaneros=GastoExtra::where('estado','pagado')->where('categoria','ADUANERO')->sum('monto_bolivianos');
        $carga=GastoExtra::where('estado','pagado')->where('categoria','CARGUIO')->sum('monto_bolivianos');;
        $otros=0;
        return view('gastos_extras.index',compact('gastos','total','cuentas_banco','aduaneros','carga','contratos','otros'));
    }
   public function store(GastoExtraRequest $request)
{
    $cuenta = CuentaBancaria::findOrFail($request->cuenta_bancaria_id);

    /* if (!$cuenta->activa) {
        return response()->json([
            'message' => 'La cuenta bancaria está inactiva'
        ], 422);
    } */

    if (
        ($request->moneda === 'BOB' && empty($request->tipo_cambio)) ||
        ($request->moneda !== 'BOB' && !empty($request->tipo_cambio))
    ) {

        $nombreComprobante = '';

        if ($request->hasFile('comprobante_pago')) {
            $path = public_path() . '/comprobantes_pago';
            $doc = $request->file('comprobante_pago');

            $name = 'comprobante_' .
                $request->input('categoria') . '_' .
                $request->input('concepto') . '-' .
                Carbon::now()->format('YmdHis');

            $nombreComprobante = $name . '.' . $doc->extension();
            $doc->move($path, $nombreComprobante);
        }

        $mon = 0;

        if ($request->moneda === 'BOB') {
            $mon = $request->monto;
        } else {
            $mon = $request->monto * $request->tipo_cambio;
        }

        $gasto = GastoExtra::create([
            'contrato_id' => $request->contrato_id,
            'cuenta_bancaria_id' => $request->cuenta_bancaria_id,
            'categoria' => $request->categoria,
            'concepto' => $request->concepto,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'moneda' => $request->moneda,
            'monto_bolivianos' => $mon,
            'tipo_cambio' => $request->moneda === 'BOB' ? null : $request->tipo_cambio,
            'comprobante_pago' => $nombreComprobante,
            'estado' => 'pagado',
        ]);

        Alert::success('Registrado', 'Gasto Extra registrado con éxito');
        return redirect()->route('gastos_extras.index');
    }

    Alert::error('Error', 'No puedes realizar el registro, datos inconsistentes');
    return redirect()->route('gastos_extras.index');
}
    public function show($id)
    {
        return GastoExtra::with(['contrato', 'cuentaBancaria'])->findOrFail($id);
    }

    public function update(GastoExtraRequest $request, $id)
    {
        $gasto = GastoExtra::findOrFail($id);

        if ($gasto->estado === 'pagado') {
           Alert::error('Error', 'No puede editar un registro pagado!!!');
        return redirect()->route('gastos_extras.index');       
        }

        $gasto->fill($request->only([
            'categoria',
            'concepto',
            'fecha',
            'monto',
            'moneda',
            'tipo_cambio',
            'comprobante_pago',
        ]));

        $gasto->updated_by = auth()->id();
        $gasto->save();
        Alert::success('Actualizacion', 'Gasto Extra Actualizado con exito!!!');
        return redirect()->route('gastos_extras.index');       

    }
    public function pagar($id)
    {
        $gasto = GastoExtra::findOrFail($id);

        if ($gasto->estado === 'pagado') {
            return response()->json([
                'message' => 'El gasto ya está pagado'
            ], 422);
        }
        $gasto->estado = 'pagado';
        $gasto->save();
        return response()->json([
            'message' => 'Gasto marcado como pagado'
        ]);
    }

    public function destroy($uuid)
    {
        $gasto = GastoExtra::where('uuid',$uuid)->firstOrFail();
        if ($gasto->estado === 'pagado') {
             Alert::error('Error', 'No puedes eliminar un gasto pagado.');
            return redirect()->route('gastos_extras.index');
        }
        $gasto->delete();
        Alert::success('Eliminacion ', 'Gasto Extra Eliminado con exito!!!');
        return redirect()->route('gastos_extras.index');       
    }
}