<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request) 
    {
        //El metodo attach sirve para insertar registros en una tabla pivote
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user, Request $request) 
    {
        //El metodo detach sirve para eliminar registros en una tabla pivote buscando por el parametro que le pasamos 
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
