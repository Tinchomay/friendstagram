@extends('layouts.app')


@section('contenido')
    <livewire:mostrar-usuarios>
    <h3 class="text-center mb-6 font-bold text-gray-500">Siguiendo</h3>
    <x-listar-post :posts="$posts" :nombre="true"/>
@endsection