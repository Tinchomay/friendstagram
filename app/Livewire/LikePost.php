<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likes;

    //Mount es como un constructor, este se ejecuta automaticamente cuando instanciamos el componente en el blade, solo ponerlo. Requiere c9omo parametro las variables que definimos cuando instanciamos el componente
    public function mount($post)
    {
        //Esto retorna un booleano al comprobar si el usuario ya le dio like o no, retorna 1 si le dio like y si no, no retorna nada
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like() 
    {
        //Tenemos que hacer referencia al post de esta clase, como ya la pasamos como parametro al componente //Y comprobamos si el usuario auten ya dio like
        if ($this->post->checkLike(auth()->user())) {
            //Nos traemos el codigo de eliminar. //Request no esta disponible en liveware, por lo que cambiamos el request por este post y vamos a buscar en sus likes este post y eliminamos el like
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            //Tenemos que rescribir el valor del atributo para que se haga el rerender
            $this->isLiked = 0;
            $this->likes -= 1;
        } else {
            Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id
            ]);
            //Tenemos que rescribir el valor del atributo para que se haga el rerender
            $this->isLiked = 1;
            $this->likes += 1;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
