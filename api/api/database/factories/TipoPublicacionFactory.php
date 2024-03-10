<?php

namespace Database\Factories;

use App\Models\TipoPublicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TipoPublicacionFactory extends Factory
{

    protected $model = TipoPublicacion::class;
    public static $pos = -1;
    public static $tipos = [
        'Eventos', 
        'Promociones',
        'Descuentos', 
        'Gastronomía',
        'Anime'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        TipoPublicacionFactory::$pos++;
        return [
            'nombre' => TipoPublicacionFactory::$tipos[TipoPublicacionFactory::$pos]
        ];
    }
}
