<div class="container mb-10">
    <h3 class="text-center mb-6 font-bold text-gray-500">Ultimos usuarios registrados</h3>
        <div class="grid grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-1">
            @forelse ($usuarios as $usuario)
            <div>
                <a href="{{route('posts.index', $usuario->username)}}" class="flex flex-col items-center gap-2">
                    <img class=" rounded-full w-4/5" src="{{ asset('perfiles') . '/' . $usuario->imagen }}" alt="">
                    <p class="font-bold text-xs">{{$usuario->username}}</p>
                </a>  
            </div>
            @empty
                <p class="text-gray-500 uppercase text-sm text-center font-bold">Aun no hay usuarios registrados</p>
            @endforelse
        </div>
</div>
