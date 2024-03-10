<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Database\Factories\MunicipioFactory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioAyuntamientoFactory extends Factory
{
    public static $current = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        UsuarioAyuntamientoFactory::$current++;
        return [
       
                'usuario' => 'ayuntamiento_'.strtolower(UsuarioAyuntamientoFactory::$current),
                'nombre' => 'Ayuntamiento de ' .MunicipioFactory::$municipios[UsuarioAyuntamientoFactory::$current],
                'direccion' => MunicipioFactory::$municipios[UsuarioAyuntamientoFactory::$current],
                'email' => MunicipioFactory::$municipios[UsuarioAyuntamientoFactory::$current].'@ayuntamientos.com',
                'telefono' => $this->faker->numberBetween(000000000, 999999999),
                'email_verified_at' => now(),
                'avatar' =>   'ayuntamiento'.MunicipioFactory::$municipios[UsuarioAyuntamientoFactory::$current].'.png',
                'id_municipio' => UsuarioAyuntamientoFactory::$current + 1,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
        ];
    }

  
}
