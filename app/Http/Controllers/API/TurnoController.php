<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $turno = Turno::all();
        return response()->json([
            'status' => true,
            'turno' => $turno
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $turno = new Turno();   
        $turno->empresa = $request->input('empresa'); 
        $turno->nombre = $request->input('nombre');   
        $turno->unidad = $request->input('unidad');
        $turno->ciclo = $request->input('ciclo');
        $turno->horario_id = $request->input('horario_id');
        $turno->save();
        return response()->json([
            'status' => true,
            'message'=> 'Turno creado con exito',
            'turno' => $turno
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $turno = Turno::find($id);
        return response()->json([
            'status' => true,
            'turno' => $turno
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
          $turno = Turno::find($id);  
          $turno->empresa = $request->input('empresa'); 
          $turno->nombre = $request->input('nombre');   
          $turno->unidad = $request->input('unidad');
          $turno->ciclo = $request->input('ciclo');
          $turno->horario_id = $request->input('horario_id');
          $turno->save();
          return response()->json([
              'status' => true,
              'message'=> 'Turno actualizado con exito',
              'turno' => $turno
          ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $turno = Turno::find($id);
        $turno->delete();
        return response()->json([
            'status' => true,
            'message'=>'Turno Eliminado',
            'turno' => $turno
        ]);
    }
}
