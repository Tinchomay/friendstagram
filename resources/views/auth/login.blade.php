@extends('layouts.app')

@section('titulo')
Inicia Sesion
@endsection

@section('contenido')
<div class="lg:flex justify-center lg:items-center lg:gap-4">
    <div class="lg:w-7/2" >
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login de usuario" class="w-auto p-5">
    </div>
    <div class="lg:w-5/12 m-5 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @if (session('mensaje')) 
                <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }} </p>
            @endif
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

            <div class=" mb-5 flex items-center">
                <input type="checkbox" name="remember" id="remember" class=" mt-1"><label for="remember" class="text-gray-500 text-sm select-none ml-1">Mantenga mi sesion abierta</label>
            </div>

            <input type="submit" value="Iniciar Sesion" class=" bg-sky-600 hover:bg-sky-700 transition cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full">
        </form>
    </div>
</div>
@endsection