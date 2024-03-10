<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Etiqueta;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EtiquetasFactory extends Factory
{
    protected $model = Etiqueta::class;
    public static $pos = -1;
    public static $categorias = [
        'Diseño', 'Videos', 'News', 'Programación', 'Anime', 'Eventos', 'Cercano' 
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        EtiquetasFactory::$pos++;
        return [
            'nombre' => EtiquetasFactory::$categorias[EtiquetasFactory::$pos]
        ];
    }
}
