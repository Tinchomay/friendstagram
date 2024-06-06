@extends('layouts.app')

@section('titulo')
{{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto md:flex px-2">
        <div class=" md:w-1/2">
            <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post  {{$post->titulo}}">
            <div class="pt-1 pb-3 flex items-center gap-2">
                @auth

                <livewire:like-post :post="$post" />

                @endauth
            </div>
            <div>
                {{-- Aqui el user viene del metodo que agregamos de la relacion inversa --}}
                <a href="{{route('posts.index', $post->user->username)}}">
                    <p class="font-bold inline-block">{{$post->user->username}}</p>
                </a>
                {{-- Laravel incluye ya una api para poder convertir estas fechas a un formato que diga hace cuanto tiene --}}
                <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }}</p>
                <p class=" mt-2"> {{ $post->descripcion }}</p>
            </div>

            {{-- Primero solo activamos este codigo si el usuario esta autenticado --}}
            @auth
                {{-- Revisamos si coinciden los id --}}
                @if ($post->user_id === auth()->user()->id)
                <form action="{{route('posts.destroy', $post)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Eliminar Publicacion" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                </form>
                @endif
            @endauth

        </div>
        <div class=" md:w-1/2">
            <div class=" shadow bg-white p-5 m-5 rounded-md ">
                {{-- <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p> --}}
                @auth
                @if (session('mensaje'))
                    <div class=" bg-green-400 p-2 uppercase rounded-lg mb-6 text-white text-center font-bold">{{session('mensaje')}}</div>
                @endif
                    <form action="{{ route('comentarios.store', ['user' => $post->user, 'post' => $post])}}" method="POST">
                        @csrf
                        <div class=" mb-1 mt-6">
                            <label for="comentario" class=" mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                            <textarea name="comentario" id="comentario" placeholder="Nuevo comentario" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror"></textarea>
                            @error('comentario')
                            <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                            @enderror
                        </div> 
                        <input type="submit" value="Agregar Comentario" class=" bg-sky-600 hover:bg-sky-700 transition cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full">
                    </form>
                @endauth
                <div class=" bg-white shadow mb-3 max-h-96 overflow-y-scroll rounded-lg mt-2">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios->sortByDesc('created_at') as $comentario)
                            <div class="py-3 px-5 border-gray-100 border-b">
                                <div class="flex items-center gap-3 mb-5">
                                    <a href="{{route('posts.index', $comentario->user)}}" class="font-bold">{{$comentario->user->username}}</a>
                                    <p class="text-sm text-gray-400">{{$comentario->created_at->diffForHumans()}}</p>
                                </div>
                                <p class=" text-gray-500">{{$comentario->comentario}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center"> No hay comentarios aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection