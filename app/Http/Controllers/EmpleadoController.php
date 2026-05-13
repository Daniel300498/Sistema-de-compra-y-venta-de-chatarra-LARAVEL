<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $empleados = Empleado::whereNull('deleted_at')->orderBy('apellido')->orderBy('nombre')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'ci'       => 'required|string|max:20',
            'cargo'    => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:150',
        ], [
            'nombre.required'   => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'ci.required'       => 'El CI es obligatorio.',
            'cargo.required'    => 'El cargo es obligatorio.',
            'email.email'       => 'El correo no tiene un formato válido.',
        ]);

        Empleado::create([
            'nombre'     => $request->nombre,
            'apellido'   => $request->apellido,
            'ci'         => $request->ci ?: null,
            'cargo'      => $request->cargo ?: null,
            'telefono'   => $request->telefono ?: null,
            'email'      => $request->email ?: null,
            'activo'     => true,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        Alert::success('Éxito', 'Empleado registrado correctamente.');
        return redirect()->route('empleados.index');
    }

    public function update(Request $request, $uuid)
    {
        $empleado = Empleado::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'ci'       => 'required|string|max:20',
            'cargo'    => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:150',
        ], [
            'nombre.required'   => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'ci.required'       => 'El CI es obligatorio.',
            'cargo.required'    => 'El cargo es obligatorio.',
            'email.email'       => 'El correo no tiene un formato válido.',
        ]);

        $empleado->update([
            'nombre'     => $request->nombre,
            'apellido'   => $request->apellido,
            'ci'         => $request->ci ?: null,
            'cargo'      => $request->cargo ?: null,
            'telefono'   => $request->telefono ?: null,
            'email'      => $request->email ?: null,
            'updated_by' => auth()->id(),
        ]);

        Alert::success('Éxito', 'Empleado actualizado correctamente.');
        return redirect()->route('empleados.index');
    }

    public function toggleActivo($uuid)
    {
        $empleado = Empleado::where('uuid', $uuid)->firstOrFail();
        $empleado->update([
            'activo'     => !$empleado->activo,
            'updated_by' => auth()->id(),
        ]);

        $msg = $empleado->activo ? 'Empleado activado.' : 'Empleado desactivado.';
        Alert::success('Listo', $msg);
        return redirect()->route('empleados.index');
    }

    public function destroy($uuid)
    {
        $empleado = Empleado::where('uuid', $uuid)->firstOrFail();
        $empleado->delete();
        Alert::success('Éxito', 'Empleado eliminado.');
        return redirect()->route('empleados.index');
    }
}
