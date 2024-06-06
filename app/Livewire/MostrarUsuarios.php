<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class MostrarUsuarios extends Component
{
    public function render()
    {
        $usuarios = User::orderBy('id', 'DESC')->take(5)->get();
        return view('livewire.mostrar-usuarios', [
            'usuarios' => $usuarios
        ]);
    }
}
