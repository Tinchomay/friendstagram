@extends('layouts.app')

@section('titulo')
Crea una nueva publicacion
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10 mx-4">
            <form action="{{ route('imagenes.store') }}" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center md:mt-10 @error('imagen') border-red-500 @enderror" method="POST" enctype="multipart/form-data">
                @csrf
            </form>
            @error('imagen')
                <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
            @enderror
        </div>
        <div class="md:w-1/2 bg-white p-8 rounded-lg shadow-xl mx-4 mt-8">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class=" mb-5 ">
                    <label for="titulo" class=" mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la publicacion" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}" required>
                    @error('titulo')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class=" mb-5 ">
                    <label for="descripcion" class=" mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripcion de la publicacion" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class=" bg-red-400 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>

                <div class=" mb-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                </div>
                <input type="submit" value="Publicar" class=" bg-sky-600 hover:bg-sky-700 transition cursor-pointer uppercase font-bold p-3 text-white rounded-lg w-full">
            </form>
        </div>
    </div>
@endsection