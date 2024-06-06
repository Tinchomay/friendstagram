<header class="bg-white" x-data="{open: false}">
    <nav class="mx-auto flex container items-center justify-between py-6 px-4 " aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="{{ route('home') }}" class="text-3xl font-black ">FriendsTagram</a>
      </div>
      <div class="flex lg:hidden">
        {{-- Boton hamburguesa --}}
        <button x-on:click="open = true" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" >
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
            @auth
            <div class="flex gap-5 items-center">
                <a class="font-bold uppercase text-gray-500 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">Hola <span class=" text-blue-500 normal-case">{{auth()->user()->username }}</span></a>
                <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-500 rounded text-sm uppercase font-bold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>Crear
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                    <button type="submit" class="font-bold uppercase text-gray-500 text-sm hover:text-red-600 transition duration-200" href="{{ route('logout') }}">Cerrar Sesion</button>
                </form>
            </div>
            @endauth
            @guest
                <div class="flex gap-5 items-center">
                    <a class="font-bold uppercase text-gray-500 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-500 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </div>     
            @endguest
      </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden mx-auto container" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="w-full bg-white px-6 sm:ring-gray-900/10 h-auto" x-show="open" x-on:click.away="open = false">
        <div class="mt-6">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="mb-4 flex justify-between items-center">
                @auth
                    <a class="font-bold uppercase text-gray-500 text-sm " href="{{ route('posts.index', auth()->user()->username) }}">Hola <span class=" text-blue-500 normal-case">{{auth()->user()->username }}</span></a>
                    <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-500 rounded text-sm uppercase font-bold cursor-pointer w-24 mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>Crear
                    </a>
                @endauth
                @guest
                    <a class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" href="{{ route('login') }}">Login</a>
                    <a class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" href="{{ route('register') }}">Crear Cuenta</a>
                @endguest
            </div>
            @auth
                <div>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                        <button type="submit" class="font-bold uppercase text-gray-500 text-sm hover:text-red-600 transition duration-200 py-6" href="{{ route('logout') }}">Cerrar Sesion</button>
                    </form>
                @endauth
            </div>
          </div>
        </div>
      </div>
    </div> 
</header>
  

