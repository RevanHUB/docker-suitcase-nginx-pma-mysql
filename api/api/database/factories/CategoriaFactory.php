<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public static $pos = -1;
    public static $categorias = [
        ['name' => 'Eventos', 'descripcion' => "Eventos"], 
        ['name' => 'Promociones', 'descripcion' => "Promociones"], 
        ['name' => 'Descuentos', 'descripcion' => "Descuentos"], 
        ['name' => 'Gastronomía', 'descripcion' => "Gastronomia"], 
        ['name' => 'Anime', 'descripcion' => "Anime"], 
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        CategoriaFactory::$pos++;
        return [
            'nombre' => CategoriaFactory::$categorias[CategoriaFactory::$pos]['name'],
            'descripcion' => CategoriaFactory::$categorias[CategoriaFactory::$pos]['descripcion']
        ];
    }
}
