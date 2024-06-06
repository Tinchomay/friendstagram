<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Como en la ruta asignamos una variablo tenemos que pasar el modelo de user y crear su variable, asi cuando visitamos esta ruta con el username de un usuario podemos ver todos sus datos
    //Aqui se pasara como parametro el usuario que escribamos en la url
    public function index(User $user) 
    {
        //Vamos a utilizar where para buscar los posts del usuario
        //Poniendo el modelo Post ya se situa en la tabla, ponenmos en que columna de la tabla vamos a buscar y pasamos el parametro a buscar, con solo el where vamos a acceder a la consulta, si queremos los resultados utilizamos el get
        //Aqui el user va a ser dinamico por cada ruta que revisemos
        // $posts = Post::where('user_id', $user->id)->get();
        //Para paginar cambiamos el metodo de get por paginate
        $posts = Post::where('user_id', $user->id)->latest()->paginate(6);

        return view('dashboard', [
            //Pasamos a la vista estas variables
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request) 
    {
        $this->validate($request, [
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //Aqui vamos a crear un post con la relacion que creamos, utilizamos el request y accedemos al user que esta en el request y detecta que usuario esta creando el posto y accedemos al metodo posts que creamos con la relacion que crea un post y finalmente utilizamos el metodo create
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show (User $user, Post $post) 
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        //Aplicamos el policy para validar si son los mismos usarios, el primer parametro seria el metodo del policy y el segundo el post donde va a validar los datos de ese post
        $this->authorize('delete', $post);

        //Aplicamos el metodo delete al post una vez que estamos autorizados
        $post->delete();

        //Eliminamos imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        //Tiene que ser el de la clase de los facades
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        //Redireccionamos
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
