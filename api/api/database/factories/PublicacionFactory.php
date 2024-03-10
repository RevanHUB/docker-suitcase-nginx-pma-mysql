<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    public static $post = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        PublicacionFactory::$post++;
        $fecha = $this->faker->dateTimeBetween(now()->subYears(5), now());
        return [
            'titulo' => 'Titulo de Post#'.PublicacionFactory::$post,
            'descripcion' => "Descripcion  de la publicación número ".PublicacionFactory::$post,
            'imagen' => 'imagen_'.PublicacionFactory::$post.'.png',
            'fecha_publicacion' => $this->faker->dateTimeBetween(now()->subYears(5), now()),
            'fecha_inicio' => $this->faker->dateTimeBetween($fecha, now()),
            'fecha_fin' =>  $this->faker->dateTimeBetween($fecha, now()),
            'activo' => 1,
            'id_tipo' => rand(1, count(TipoPublicacionFactory::$tipos))
        ];
    }
}
