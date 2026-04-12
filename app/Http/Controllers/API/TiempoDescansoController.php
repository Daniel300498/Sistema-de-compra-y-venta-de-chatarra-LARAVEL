<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TiempoDescanso;
use Illuminate\Http\Request;

class TiempoDescansoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $tiempoDescanso = TiempoDescanso::all();
        return response()->json([
            'status' => true,
            'tiempo_descanso' => $tiempoDescanso
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tiempo_descanso = new TiempoDescanso();   
        $tiempo_descanso->empresa = $request->input('empresa');   
        $tiempo_descanso->nombre = $request->input('nombre');
        $tiempo_descanso->hora_inicial= $request->input('hora_inicial');   
        $tiempo_descanso->hora_final = $request->input('hora_final');
        $tiempo_descanso->duracion_descanso = $request->input('duracion_descanso');   
        $tiempo_descanso->tipo_calculo = $request->input('tipo_calculo');
        $tiempo_descanso->estado_marcacion = $request->input('estado_marcacion');
        $tiempo_descanso->save();
        return response()->json([
            'status' => true,
            'message' => "Tiempo Descanso creado con exito",
            'tiempo_descanso' => $tiempo_descanso
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tiempo_descanso=TiempoDescanso::find($id);
        return response()->json([
            'status' => true,
            'tiempo_descanso' => $tiempo_descanso
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tiempo_descanso=TiempoDescanso::find($id);  
        $tiempo_descanso->empresa = $request->input('empresa');   
        $tiempo_descanso->nombre = $request->input('nombre');
        $tiempo_descanso->hora_inicial= $request->input('hora_inicial');   
        $tiempo_descanso->hora_final = $request->input('hora_final');
        $tiempo_descanso->duracion_descanso = $request->input('duracion_descanso');   
        $tiempo_descanso->tipo_calculo = $request->input('tipo_calculo');
        $tiempo_descanso->estado_marcacion = $request->input('estado_marcacion');
        $tiempo_descanso->save();
        return response()->json([
            'status' => true,
            'message' => "Tiempo Descanso actualizado con exito",
            'tiempo_descanso' => $tiempo_descanso
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tiempo_descanso=TiempoDescanso::find($id);
        $tiempo_descanso->delete();
        return response()->json([
            'status' => true,
            'message'=>'Tiempo de descanso eliminaso',
            'tiempo_descanso' => $tiempo_descanso
        ], 200);
    }
}
