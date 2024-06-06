<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//Principal
Route::get('/', HomeController::class)->name('home')->middleware('auth');


//Utilizamos el primer parametro para direccion y el segundo para el metodo del controlador
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Si ponemos la ruta de esta manera la estamos convirtiendo en una variable, en esta direccion vamos a poner el modelo asi en minusculas, asi estamos aplicando model route building
//En la ruta aparte del modelo debemos de poner dos puntos y la columna de la base de datos que queremos que se muestre
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
//Necesitara el id para buscar el post
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

//Comentarios
Route::post('{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store')->middleware('auth');

//Imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store')->middleware('auth');

//Like
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store')->middleware('auth');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy')->middleware('auth');

//Perfil
Route::get('{user:username}/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('{user:username}/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store')->middleware('auth');

//Seguir usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow')->middleware('auth');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow')->middleware('auth');