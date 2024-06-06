<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        
        Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        return back();
    }

    public function destroy (Request $request, Post $post)
    {
        //En el request viene el usuario, el usuario es la persona que esta haciendo el request, osea valida quien esta autenticado y en el usuario ya vienen los likes, buscamos en los likes de este usuario el post id con where y eliminamos ese resultado
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
