<div>
    {{-- El boton ya no va a requerir el form. Vamos a agregar un evento a ese boton, por medio de wire:evento="funcion", va a ejecutar la funcion que asignemos y tiene que estar en la clase del componente --}}
    <button wire:click="like">
        {{-- Aqui vamos a mostrar un valor u otro depende de la consulta y cuando definamos el valor de esta variable para que el componente haga el re render --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $isLiked ? 'red' : 'white' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>
    </button>
    <p class=" font-bold">{{ $likes }} <span class="font-normal">@choice('Like|Likes', $likes)</span></p>
</div>
