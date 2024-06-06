<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request) 
    {
        //Aqui tenemos acceso a la imagen
        $imagen = $request->file('file');

        //Asignar un nombre aleatorio a la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Creamos la instancia de image manager con driver para tener multiples opciones
        $manager = new ImageManager(new Driver());

        //Leemos la imagen y cambiamos tamaño
        $imagenServidor = $manager::imagick()->read($imagen);
        $imagenServidor->cover(1000,1000);

        //Creamos la direccion donde se guardaran las imagenes con el nombre de la imagen
        //La funcion public path apunta a la carpeta public, aqui entre parentesis se selecciona una carpeta}
        //Si marca error de que no se puede escribir, nosotros tenemos que crear la carpeta
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        //Dara como resultado public/uploads/546541.jpg

        //Guardamos la imagen
        $imagenServidor->save($imagenPath);

        return response()->json([
            'imagen' => $nombreImagen,
        ]);  
    }
}
