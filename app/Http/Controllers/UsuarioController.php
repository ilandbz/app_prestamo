<?php

namespace App\Http\Controllers;

use App\Models\Gestor;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UsuarioController extends Controller
{
    public function index(){
        if(session('tipo_usuario')=='Supervisor'){
            // $usuarios=User::with('TipoUsuario:id,nombre')->where('id_tipo_user', 3)->paginate(10);
            // return view('usuarios.inicio', compact('usuarios')); 

            $usuarios=Gestor::with('usuario:id,name,email,telefono,direccion,imagen')->where('id_supervisor', Auth::user()->id)->paginate(10);
            return view('usuarios.inicio', compact('usuarios')); 
        }else{
            $usuarios=User::with('TipoUsuario:id,nombre')->paginate(10);
            return view('usuarios.inicio', compact('usuarios'));            
        }
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_tipo_user' => ['required'],
        ]);
        if ($request->hasFile('imagen')) {
            // El archivo 'imagen' ha sido cargado en la solicitud
            $file = $request->file('imagen');
            $nombre_archivo = time().".".mb_strtolower($file->extension());
            Storage::disk('public')->put('profiles/'.$nombre_archivo,File::get($file));
        }else{
            $nombre_archivo = 'default.png';
        }
        $user = User::create([
            'dni'  => $request->dni,
            'name' => $request->name,
            'email' => $request->email,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->password),
            'imagen'    => $nombre_archivo,
            'id_tipo_user' => $request->id_tipo_user
        ]);
        if($request->id_tipo_user==3){//es gestor
            Gestor::create([
                'id_usuario'    => $user->id,
                'id_supervisor' => $request->id_supervisor
            ]);
        }
        $request->session()->flash('success', 'Los datos se han Guardaron exitosamente.');
        return redirect()->route('usuarios.create');
    }
    public function edit(User $usuario){
        return view('usuarios.inicio', compact('usuario'));
    }
    public function create(){
        return view('usuarios.inicio');
    }
    public function update(User $usuario, Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'id_tipo_user' => ['required']
        ]);
        if($request->password!=''){
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre_archivo = time().".".mb_strtolower($file->extension());
            Storage::disk('public')->put('profiles/'.$nombre_archivo,File::get($file));
        } else {
            $nombre_archivo = $usuario->imagen;
        }
        $usuario->dni=$request->dni;
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->telefono=$request->telefono;
        $usuario->direccion=$request->direccion;
        $usuario->password=Hash::make($request->password);
        $usuario->imagen=$nombre_archivo;
        $usuario->id_tipo_user=$request->id_tipo_user;
        $usuario->save();
        $request->session()->flash('success', 'Los datos se han actualizaron exitosamente.');
        return redirect()->route('usuarios.index');
    }
    public function show(User $user){
        return redirect()->route('usuarios.index');
    }
    public function destroy(User $usuario){
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
    public function cargarlista(Request $request){
        $descripcion = $request->descripcion;
        $usuarios=User::with('TipoUsuario:id,nombre')->where('name', 'like', '%'.$descripcion.'%')->orWhere('email', 'like', '%'.$descripcion.'%')->paginate(10);
        $vista = view('usuarios.tabla', compact('usuarios'))->render();
        return response()->json(['html' => $vista]);
    }
    public function cargarsupervisores(){
        $usuarios = User::where('id_tipo_user', 2)->get();//todos los gestores
        $vista = view('usuarios.supervisorselect', compact('usuarios'))->render();
        return response()->json(['html' => $vista]);
    }
}
