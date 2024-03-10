<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioParticularFactory extends Factory
{

    public static $current = -1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        UsuarioParticularFactory::$current++;
        return [
            'usuario' => 'cliente_'.UsuarioParticularFactory::$current,
            'nombre' => 'Nombre de cliente ' . UsuarioParticularFactory::$current,
            'direccion' => MunicipioFactory::$municipios[UsuarioParticularFactory::$current],
            'email' => 'cliente_'.UsuarioParticularFactory::$current.'@particulares.com',
            'telefono' => $this->faker->numberBetween(000000000, 999999999),
            'email_verified_at' => now(),
            'avatar' =>   'cliente_'.UsuarioParticularFactory::$current.'.png',
            'id_municipio' => UsuarioParticularFactory::$current + 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
    ];
    }

}
