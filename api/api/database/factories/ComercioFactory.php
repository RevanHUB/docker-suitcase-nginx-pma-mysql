<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComercioFactory extends Factory
{
     /* asignados en creación del 11 al 16*/
     public static $usuario = 11;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        ComercioFactory::$usuario++;
        return [
            'descripcion' => 'Comercio#'. ComercioFactory::$usuario .'',
            'id_usuario' => ComercioFactory::$usuario,
            'id_categoria' => rand(1, 5)
        ];
    }
}
