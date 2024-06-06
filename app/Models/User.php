<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'imagen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts() 
    {
        //Relacion de uno a muchos
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena seguidores
    //Esta relacion cuando la consultamos con user ($user->followers) nos arroja que usuarios nos siguen, osea aplica un where a la tabla de followers en la columna de user_id
    public function followers() 
    {
        //Aqui este metodo lo que va a hacer es insertar usuarios en la tabla de followers user_id que es sera el usuario al cual le apliquemos el metodo, y follower_id que sera la persona que este autenticada por que eso pasaremos como parametro en el metodo attach
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
        //Aqui el primer parametro el con que estarara relacionado, el segundo parametro es la tabla pivote, el tercero sera la llave foranea del usuario al que le estamos aplicando el meotodo y el cuarto la llave foranea que pasaremos con el attach
    }

    //Metodo para comproba si un usuario ya sigue a otro
    //Aqui el metodo utilizar followers para buscar todos los followers del user de la publicacion y comprobar si contiene el usuario autenticado
    public function siguiendo(User $user) 
    {
       return $this->followers->contains($user->id); 
    }


    //Revisar a los que seguimos
    public function followings() 
    {
        //Aqui follower_id representa la persona que realiza el seguimiento y user_id representa a quien sigue, estas dos columnas esta en la tabla pivote de followers, cuando la utilicemos para contar va a contar cuantas veces esta el usuario en la columna de follower_id
        //Va a realizar la busqueda siempre del tercer parametro
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
}
