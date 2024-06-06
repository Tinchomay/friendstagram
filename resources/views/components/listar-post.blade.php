@if ($posts->count())
    <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mx-4">
        @foreach ($posts as $post)
            <div>
                {{-- Como el route espera un post podemos pasar solo post o el post->id --}}
                <a href="{{route('posts.show', ['post' => $post, 'user' => $post->user])}}">
                    <img src="{{ asset('/uploads/' . $post->imagen) }}" alt="Imagen del post {{$post->titulo}}">
                </a>
                @if ($nombre)
                    <a href="{{route('posts.index', $post->user->username)}}" class=" inline-block mb-4">
                        <p class="font-bold">{{$post->user->username}}</p>
                    </a>  
                @endif
            </div>
        @endforeach
    </div>
    <div class="my-10 mx-4">
        {{-- Aqui podemos elegir distintos tipos de paginacion por default esta la de pagination:tailwind pero tenemos que añadir tailwind a la paginacion --}}
        {{ $posts->links('pagination::tailwind') }}
    </div>
@else
    <p class=" text-gray-500 uppercase text-sm text-center font-bold">No hay posts</p>
@endif