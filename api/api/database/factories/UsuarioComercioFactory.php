<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsuarioComercio>
 */
class UsuarioComercioFactory extends Factory
{

    public static $current = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        UsuarioComercioFactory::$current++;
        return [
       
                'usuario' => 'comercio_'.strtolower(UsuarioComercioFactory::$current),
                'nombre' => 'Comercio de ' .MunicipioFactory::$municipios[UsuarioComercioFactory::$current],
                'direccion' => MunicipioFactory::$municipios[UsuarioComercioFactory::$current],
                'email' => 'comercio_'.MunicipioFactory::$municipios[UsuarioComercioFactory::$current].'@comercios.com',
                'telefono' => $this->faker->numberBetween(000000000, 999999999),
                'email_verified_at' => now(),
                'avatar' =>   'comercio'.MunicipioFactory::$municipios[UsuarioComercioFactory::$current].'.png',
                'id_municipio' => UsuarioComercioFactory::$current + 1,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
        ];
    }


}
