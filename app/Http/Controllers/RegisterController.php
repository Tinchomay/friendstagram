<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index () 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // dd($request->get('name'));

        //Reescribimos el valor de username agrengando el metodo add y como un array asignando el nuevo valor para usename
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validando formularios
        //$this hacinedo referencia a esta instancia y lleva el metodo validate, este lleva dos parametros, el primero es el request y el segundo los parametros de validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            //Haremos que el username sea unico y se valide con la tabla de users y con minimos y maximos
            'username' => 'required|unique:users|min:3|max:25|not_in:editar-perfil,twitter,register,login,logout,posts,posts/create,imagenes',
            //Validamos que solo exista un correo
            'email' => 'required|unique:users|email|max:60',
            //Confirmed confirma si las contraseñas son iguales pero requiere que el segundo password tenga en el name password_confirmation
            'password' => 'required|confirmed|min:6'
        ]);
        
        //Si no hay errores el codigo continua de manera automatica
        //Creamos un registro con el metodo create y pasando los parametros correspondientes
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionamos con el helpper redirect, le pasamos el route y dentro del route podemos poner el name de los links
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
