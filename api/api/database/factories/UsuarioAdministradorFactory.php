<?php

namespace Database\Factories;

use App\Models\UsuarioAdministrador;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioAdministradorFactory extends Factory
{
    public static $admin = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        UsuarioAdministradorFactory::$admin++;
        return [
            'usuario' => 'admin_'.UsuarioAdministradorFactory::$admin,
            'nombre' => 'Admin de Zona ',
            'direccion' => MunicipioFactory::$municipios[UsuarioAdministradorFactory::$admin],
            'email' => MunicipioFactory::$municipios[UsuarioAdministradorFactory::$admin].'@administradores.com',
            'telefono' => $this->faker->numberBetween(000000000, 999999999),
            'email_verified_at' => now(),
            'avatar' =>   'admin_'.MunicipioFactory::$municipios[UsuarioAdministradorFactory::$admin].'.png',
            'id_municipio' => UsuarioAdministradorFactory::$admin,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
