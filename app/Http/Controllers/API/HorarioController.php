<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $horario = Horario::all();
        return response()->json([
            'status' => true,
            'horario' => $horario
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $horario = new Horario();  
        $horario->empresa = $request->input('empresa'); 
        $horario->nombre = $request->input('nombre');    
        $horario->entrada_turno = $request->input('entrada_turno');
        $horario->inicio_entrada_turno = $request->input('inicio_entrada_turno');
        $horario->final_entrada_turno = $request->input('final_entrada_turno');
        $horario->dia_pagado = $request->input('dia_pagado');
        $horario->salida_turno = $request->input('salida_turno');
        $horario->inicio_salida_turno = $request->input('inicio_salida_turno');
        $horario->final_salida_turno = $request->input('final_salida_turno');
        $horario->ajuste_color = $request->input('ajuste_color');
        $horario->id_tiempo_descanso = $request->input('id_tiempo_descanso');
        $horario->necesario_marcar_entrada = $request->input('necesario_marcar_entrada');
        $horario->permite_llegar_tarde = $request->input('permite_llegar_tarde');
        $horario->acordes_marcacion = $request->input('acordes_marcacion');
        $horario->necesario_marcar_salida = $request->input('necesario_marcar_salida');
        $horario->permite_salida_tarde = $request->input('permite_salida_tarde');
        $horario->hora_cambio_dia = $request->input('hora_cambio_dia');
        $horario->save();
        return response()->json([
            'status' => true,
            'message' => "Horario creado con exito",
            'horario' => $horario
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $horario = Horario::find($id);
        return response()->json([
            'status' => true,
            'horario' => $horario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $horario=Horario::find($id);
        $horario->empresa = $request->input('empresa'); 
        $horario->nombre = $request->input('nombre');    
        $horario->entrada_turno = $request->input('entrada_turno');
        $horario->inicio_entrada_turno = $request->input('inicio_entrada_turno');
        $horario->final_entrada_turno = $request->input('final_entrada_turno');
        $horario->dia_pagado = $request->input('dia_pagado');
        $horario->salida_turno = $request->input('salida_turno');
        $horario->inicio_salida_turno = $request->input('inicio_salida_turno');
        $horario->final_salida_turno = $request->input('final_salida_turno');
        $horario->ajuste_color = $request->input('ajuste_color');
        $horario->id_tiempo_descanso = $request->input('id_tiempo_descanso');
        $horario->necesario_marcar_entrada = $request->input('necesario_marcar_entrada');
        $horario->permite_llegar_tarde = $request->input('permite_llegar_tarde');
        $horario->acordes_marcacion = $request->input('acordes_marcacion');
        $horario->necesario_marcar_salida = $request->input('necesario_marcar_salida');
        $horario->permite_salida_tarde = $request->input('permite_salida_tarde');
        $horario->hora_cambio_dia = $request->input('hora_cambio_dia');
        $horario->save();
        return response()->json([
            'status' => true,
            'message' => "Horario actualizado con exito",
            'horario' => $horario
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $horario = Horario::find($id);
        $horario->delete();
        return response()->json([
            'status' => true,
            'message'=> 'Horario Eliminado',
            'horario' => $horario
        ]);
    }
}
