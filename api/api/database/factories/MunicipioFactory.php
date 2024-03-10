<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Municipio>
 */
class MunicipioFactory extends Factory
{
    public static $pos = -1;
    public static $municipios = [
        'Los Llanos', 'Santa Cruz', 'Breña Alta', 'Breña Baja', 'Mazo'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        MunicipioFactory::$pos++;
        return [
            'nombre' => MunicipioFactory::$municipios[MunicipioFactory::$pos]
        ];
    }
}
