<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FriendSTagram - @yield('titulo')</title>
        @stack('styles')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100 items-center">
        <livewire:navegacion-component>
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class=" text-gray-500 p-5 text-center font-bold uppercase mt-10">
            {{-- el helpper para la fecha es este y nos puede mostrar toda la fecha --}}
            FriendsTagram ASM - Todos los derechos Reservados {{ now()->year }}
        </footer>
        @livewireScripts
    </body>
</html>
