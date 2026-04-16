<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles=Role::where('id','>',1)->withCount('users')->get();
        //$roles=Role::get();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions=Permission::all();
        $grupos=Permission::select('grupo')->distinct()->get();
        //dd($grupos);
        $role= new Role();
        return view('roles.create',compact('permissions','role','grupos'));
    }


     public function store(RoleRequest $request)
    {
        //dd($request->all());
        $role=Role::create(['name'=>$request->name,'descripcion'=>$request->descripcion,'guard_name'=>'web']);
        //actualice los permisos

        $role->syncPermissions($request->get('permissions'));
        Alert::success('Guardado','Rol creado con exito!');
        return redirect()->route('roles.index');

    }

    public function show($uuid)
    {
        $role=Role::where('uuid',$uuid)->firstOrFail();
        $permissions=$role->permissions;
        $grupos=DB::table('role_has_permissions as rp')->join('permissions as p','p.id','=','rp.permission_id')->where('rp.role_id',$role->id)->select('grupo')->distinct()->get();
        //dd($grupos);
        return view('roles.show',compact('role','permissions','grupos'));
    }

    public function edit($uuid)
    {
        $role=Role::where('uuid',$uuid)->firstOrFail();
        $permissions=Permission::all();
        $grupos=Permission::select('grupo')->distinct()->get();
        //dd($grupos);
        return view('roles.edit',compact('role','permissions','grupos'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        //actualice el rol
        $role->update($request->all());
        //actualice los permisos
        $role->permissions()->sync($request->get('permissions'));
        Alert::success('Actualizado','Datos del Rol actualizado con exito!');
        return redirect()->route('roles.index');
    }


    public function destroy($uuid)
    {
        //dd($role);
        $role=Role::where('uuid',$uuid)->firstOrFail();
        DB::table('role_has_permissions')->where('role_id',$role->id)->delete();
        DB::table('roles')->where('id',$role->id)->delete();
       //$role->delete();
       Alert::success('Eliminado','Rol eliminado con exito!');
       return redirect()->route('roles.index');
    }
}
