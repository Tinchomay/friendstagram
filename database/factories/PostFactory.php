<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //En sentence podemos poner que cree palabras de la extension que queramos de palabras
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            //Aqui creara un uuid o uniqueid y le concatenara jpg
            'imagen' => $this->faker->uuid() . '.jpg',
            //Aqui con randomElement podemos pasar un array e ira probando
            //Aqui es bueno para probar el contraint y ver que no cree posts con usuarios que no existan
            'user_id' => $this->faker->randomElement([1, 6, 7])
        ];
    }
}
