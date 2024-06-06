<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        //Aqui consultamos a que usuarios seguimos y con pluck podemos solo traernos los resultados de ciertas columnas y con el metodo array convertimos a array los resultados
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }
}

