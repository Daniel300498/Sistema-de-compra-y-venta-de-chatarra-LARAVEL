<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AsignacionTurno;
use Illuminate\Http\Request;

class AsignacionTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $asignacion_turno = AsignacionTurno::all();
        return response()->json([
            'status' => true,
            'asignacion_turno' => $asignacion_turno
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $asignacion = new AsignacionTurno();   
        $asignacion->fecha_inicial = $request->input('fecha_inicial');   
        $asignacion->fecha_final = $request->input('fecha_final');
        $asignacion->turno_id = $request->input('turno_id');
        $asignacion->empleado_id = $request->input('empleado_id');
        $asignacion->save();
        return response()->json([
            'status' => true,
            'message'=>'Se asigno un turno aun empleado',
            'asignacion_turno' => $asignacion
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $asignacion_turno = AsignacionTurno::find($id);
        return response()->json([
            'status' => true,
            'asignacion_turno' => $asignacion_turno
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $asignacion = AsignacionTurno::find($id);  
        $asignacion->fecha_inicial = $request->input('fecha_inicial');   
        $asignacion->fecha_final = $request->input('fecha_final');
        $asignacion->turno_id = $request->input('turno_id');
        $asignacion->empleado_id = $request->input('empleado_id');
        $asignacion->save();
        return response()->json([
            'status' => true,
            'message'=>'Se actualiso el turno del empleado',
            'asignacion_turno' => $asignacion
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $asignacion_turno = AsignacionTurno::find($id);
        $asignacion_turno->delete();
        return response()->json([
            'status' => true,
            'message'=> 'Asignacion de Turno Eliminado',
            'asignacion_turno' => $asignacion_turno
        ]);
    }
}
