<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        //Podemos definir que columnas traernos en la consulta
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class); 
    }

    public function likes()
    {
        return $this->hasMany(Like::class); 
    }

    public function checkLike(User $user) 
    {
        //Lo que hace esto es posicionarse en la tabla de likes y busca en la columna de user_id el segundo parametro que pasamos
        //Para que funcione tenemos que tener creado el metodo de likes
        return $this->likes->contains('user_id', $user->id);
    }
}
