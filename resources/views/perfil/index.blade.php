@extends('layouts.app')

@section('titulo')
Editar perfil: {{auth()->user()->name . ' (' . auth()->user()->username . ')'}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow">
            <form action="{{route('perfil.store', auth()->user()->username)}}" class="mt-10 md:mt-0 p-4" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu Username" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="imagen" class=" mb-2 block uppercase text-gray-500 font-bold">Imagen</label>
                    @if (auth()->user()->imagen)
                    <p>Seleccionar otra solo si desea cambiarla</p>
                    @endif
                    <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-lg  accept=".jpg, .jpeg, .png" value="">
                </div>
                <div>
                    @if (auth()->user()->imagen)
                        <p class="mb-2 block text-gray-500 text-sm">Imagen anterior</p>
                        <div class="mb-5">
                            <img class=" h-24 w-24 shadow-md rounded-full" src="{{asset('perfiles') . '/' . auth()->user()->imagen}}" alt="Imagen de perfil de {{$user->name}}">
                        </div>     
                    @endif
                </div>
                <div class=" mb-5">
                    <p class="mb-2 block text-gray-500 text-sm">Si desea cambiar su password tiene que ingresar su antiguo password</p>
                    @if (session('mensaje'))
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }} </p>
                    @endif
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">Password Anterior</label>
                    <input type="password" name="password" id="password" placeholder="Tu Anterior Password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="new_password" class=" mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Nuevo Password" class="border p-3 w-full rounded-lg">
                </div>
                <input type="submit" value="Guardar cambios" class=" bg-sky-600 hover:bg-sky-700 transition cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full">
            </form>
        </div>
    </div>
@endsection