<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Requests\CamaRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CamasController extends Controller
{
    public function index()
     {
        $camas=Cama::with('salas')->get();
        return view('camas.index',compact('camas'));
     }
    public function create($uuidsala)
     {
        $sala=Sala::where('uuid',$uuidsala)->firstOrFail();
        $camas=Cama::all();
        $camas_depende=Cama::where('sala_id',$sala->id)->get();
        return view('camas.create',compact('sala','camas','camas_depende'));
     }
    public function store(CamaRequest $request)
     {
         $cama= new Cama();
         $cama -> numero = $request->input('numero');
         $cama -> estado = $request->input('estado');
         $cama->sala_id = $request->sala_id;
         $cama -> save();
         $uuidSala = sala::where('id',$cama->sala_id)->first();
         Alert::success('Guardado', 'Cama Guardada con exito!!!');
         return redirect()->route('camas.create',$uuidSala->uuid);
    }
    public function edit($uuid)
     {   
         $cama=Cama::where('uuid',$uuid)->firstOrFail();
         $sala = Sala::where('id', $cama->sala_id)->first();
         $camas=cama::all();
         $camas_depende=Cama::where('sala_id',$sala->id)->get();
         return view('camas.edit',compact('cama','camas','sala','camas_depende'));
      }
    public function update(CamaRequest $request, cama $cama)
    {
         $cama->update($request->all());
         $uuidSala = sala::where('id',$cama->sala_id)->first();
         Alert::success('Guardado', 'Sala actualizada correctamente.');
         return redirect()->route('camas.create',$uuidSala->uuid);
      }
    public function destroy($uuid)
     {
         $cama=cama::where('uuid',$uuid)->firstOrFail();
         $uuidSala = sala::where('id',$cama->sala_id)->first();
         $cama->delete();
        Alert::success('Eliminación', 'Cama Eliminada con éxito!!!');
        return redirect()->route('camas.create', $uuidSala->uuid);
     }
}
