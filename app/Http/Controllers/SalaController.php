<?php

namespace App\Http\Controllers;

use App\Models\Sala; 
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SalaRequest;
use App\Models\Cama;
use Illuminate\Validation\Rule;

class SalaController extends Controller
{
    public function index()
     {
        $salas = Sala::all(); 
        return view('salas.index', compact('salas')); 
     }

    public function create()
     {
        return view('salas.create');
     }   
    public function store(SalaRequest $request)
     {
        Sala::create($request->all());
        Alert::success('Guardado', 'Sala creada correctamente.');
        return redirect()->route('salas.index');  
     }

    public function edit($uuid)
    {
        $sala=Sala::where('uuid',$uuid)->firstOrFail();
        return view('salas.edit', compact('sala'));
    }
    public function update(SalaRequest $request, sala $sala)
     {
         $sala->update($request->all());
         Alert::success('Guardado', 'Sala actualizada correctamente.');
         return redirect()->route('salas.index');
     }
 
    public function show($uuid)
     {
       // $camas=Parametro::where('tipo','Cama')->get(); // select* from Cama
       $sala=sala::where('uuid',$uuid)->firstOrFail();
       $camas=Cama::all(); // select* from Cama
       return view('salas.update', compact('camas','sala'));
     }
   
    public function destroy($uuid)
     {
       $sala=sala::where('uuid',$uuid)->firstOrFail();
        $camas=Cama::where('sala_id',$sala->id)->count();
        if($camas>0){
            Alert::warning('Eliminacion', 'No se puede eliminar la sala porque tiene camas asociadas.');
            return redirect()->route('salas.index');
        }
        $sala->delete();
        Alert::Success('Eliminacion', 'Sala eliminada correctamente.');
        return redirect()->route('salas.index');
     }
}
