<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use YoHang88\LetterAvatar\LetterAvatar;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users=User::with(['roles','ubicacion'])->where('id','<>',1)->get();
        return view('users.index',compact('users'));
    }

   public function create()
    {
        $roles=Role::where('id','>',1)->get();
        $user=new User();
        return view('users.create',compact('roles','user'));
    }

    public function datos_empleado(Request $request){
        $empleado=Empleado::find($request->id);
        return response()->json($empleado);
    }

   public function store(UserRequest $request)
    {
        $user=new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $avatar = new LetterAvatar($request->name,'circle', 64);
        $path=public_path().'/assets/avatar/'.$user->id.'.jpg';
        $avatar->saveAs($path, LetterAvatar::MIME_TYPE_JPEG);
        
        $user->roles()->sync($request->role_id);
        Alert::success("Usuario registrado correctamente!");
        return redirect()->route('users.index');
    }  
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:7|confirmed',
        ]);

        $user = User::find(auth()->user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Error', 'La contraseña actual no es correcta');
           return redirect()->back();
        }

        if (Hash::check($request->new_password, $user->password)) {
            Alert::error('Error', 'La NUEVA CONTRASEÑA no puede ser igual a la constraseña actual');
           return redirect()->back();
        }
         
         if (strlen($request->new_password) < 7) {
            Alert::error('Error', 'La NUEVA CONTRASEÑA debe tener al menos 8 caracteres');
            return redirect()->back();
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        Alert::success('Contraseña', 'Actualizada correctamente');
        return redirect()->back();
    }

    public function show($uuid)
    {
        $user=User::where('uuid',$uuid)->firstOrFail();
        return view('users.profile',compact('user'));
    }

   public function edit($uuid)
    {
        $user=User::where('uuid',$uuid)->firstOrFail();
        $roles=Role::where('id','>',1)->get();
        return view('users.edit',compact('user','roles'));
    }

     public function update(UserRequest $request, User $user)
    {        
        $usuario= User::where('id',$user->id)->first();
        $user->name=$request->name;
        $user->save();
        $user->roles()->sync($request->role_id);
        Alert::success('Datos actualizados correctamente!');
        return redirect()->route('users.index');
    }

    public function update_profile(Request $request, User $user){
        
        $file_foto=$request->file('avatar');
        if($file_foto != null){
            $direccion=public_path()."/assets/avatar/";
            $fullPath=public_path().'/assets/avatar/'.$user->avatar;
            File::delete($fullPath);
            $filename=$file_foto->getClientOriginalName();
            $file_foto->move($direccion, $filename);
            $user->avatar=$filename;
        }else{
            $path=public_path()."/assets/avatar/".$user->id.'.jpg';
            if (!file_exists($path)){
                $avatar = new LetterAvatar($request->name,'circle', 64);
                $avatar->saveAs($path, LetterAvatar::MIME_TYPE_JPEG);
            }
            $user->avatar=$user->id.'.jpg';
        }
        $user->save();
        Alert::success('Datos actualizados correctamente!');
        return redirect()->back();
    }


    public function destroy($uuid)
    {
        $user=User::where('uuid',$uuid)->firstOrFail();
        $user->delete();
        Alert::success('Usuario Eliminado correctamente!');
        return redirect()->route('users.index');
    }
}
