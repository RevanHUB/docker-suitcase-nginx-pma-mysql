<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ayuntamiento>
 */
class AyuntamientoFactory extends Factory
{

    /* asignados en creación del 2 al 6*/
    public static $usuario = 1;
    /* asignados en creación del 2 al 6 */
    public static $token = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        AyuntamientoFactory::$usuario++;
        AyuntamientoFactory::$token++;
        return [
            'id_usuario' => AyuntamientoFactory::$usuario,
            'id_token' => AyuntamientoFactory::$token
        ];
    }
}
