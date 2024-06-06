<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {
        if (Auth::check()) {
            return redirect()->route('posts.index', auth()->user());
        } else {
            return view('auth.login');
        }
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Validamos si son las credenciales, esto retorna true o false
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            //Estos metodos colocaran esta mensaje en una sesion, tenemos que mostrarlo
            //Back lo qyue hace es retornar al usuario a una pagina, en este caso regresar a login pero con un mensaje
            //Back es una forma de llenar los valores de session, y llenar los datos en en un controlador y mostrarlos en las vistas
            return back()->with('mensaje', 'Credenciales Incorrectas');
        } 
        return redirect()->route('home');
    }



}
