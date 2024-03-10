<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Particular>
 */
class ParticularFactory extends Factory
{
    /* asignados en creación del 6 al 10*/
    public static $usuario = 6;

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        ParticularFactory::$usuario++;
        return [
            'apellidos' =>  'apellido1_apellido2_de_'.ParticularFactory::$usuario,
            'sexo' =>  $this->faker->randomElement(['Masculino', 'Femenino']),
            'edad' =>  rand(18,90),
            'fecha_nacimiento'=> $this->faker->dateTimeBetween('-80 years','-18 years'),
            'id_usuario' => ParticularFactory::$usuario,
        ];
    }
}
