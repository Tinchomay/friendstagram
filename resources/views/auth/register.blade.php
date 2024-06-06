@extends('layouts.app')

@section('titulo')
Registrate
@endsection

@section('contenido')
    {{-- md antes indica que a partir de un tamaño se aplique flex --}}
    <div class="lg:flex justify-center lg:items-center lg:gap-4">
        <div class="lg:w-7/2" >
            {{-- la funcion asset apunta directamente a public --}}
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de inicio de sesion" class="w-auto p-5">
        </div>
        <div class="lg:w-5/12 m-5 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class=" mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}" required>
                    @error('username')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="email" class=" mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu Email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="password_confirmation" class=" mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite tu Password" class="border p-3 w-full rounded-lg" required>
                </div>

                <input type="submit" value="Crear Cuenta" class=" bg-sky-600 hover:bg-sky-700 transition cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full">
            </form>
        </div>
    </div>
@endsection