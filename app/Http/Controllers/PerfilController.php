<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    
    public function index (User $user)
    {
        if(auth()->user()->id !== $user->id) {
            return redirect()->route('login');
        }

        return view('perfil.index', [
            'user' => $user
        ]);
    }

    public function store (Request $request, User $user) 
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            //Podemos agregar las reglas en un array mejor y evitar que un usuario tome nombre de rutas, tambien podemos solo poner de una lista con in: y funciona como not
            //Con este codigo podemos dejar que el usuario conserve su mismno username 'unique:users,username,' . auth()->user()->id
            'username' => ['required', 'unique:users,username,' . auth()->user()->id,' min:3', 'max:25', 'not_in:editar-perfil,twitter,register,login,logout,posts,posts/create,imagenes'],
        ]);

        //Si hay imagen guardamos la imagen
        if($request->imagen) {
            //name de la imagen en el form
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = new ImageManager(new Driver());
            $imagenServidor = $manager::imagick()->read($imagen);
            $imagenServidor->cover(1000,1000);
            //Recordar crear la carpeta
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
            if(auth()->user()->imagen) {
                $imagen_anterior_path = public_path('perfiles/' . auth()->user()->imagen);
                //Tiene que ser el de la clase de los facades
                if(File::exists($imagen_anterior_path)) {
                    unlink($imagen_anterior_path);
                }
            }
        }
        //Buscar el usuario
        $usuario = User::find(auth()->user()->id);
        if($request->new_password) {
            $request->request->add(['email' => auth()->user()->email]);
            if(!auth()->attempt($request->only('email', 'password'))) {
                return back()->with('mensaje', 'Contraseña incorrecta');
            } else {
                $usuario->password = Hash::make($request->new_password);
            }
        }
        $usuario->username = $request->username;
        //Aplicamos dos placeholders por si el usuario cuenta ya con una imagen se quede esa misma
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ??  null;
        $usuario->save();
        //Redireccionamos a su muro pero con el ultimo valor del username por si lo cambio
        return redirect()->route('posts.index', $usuario->username);
    }
}
