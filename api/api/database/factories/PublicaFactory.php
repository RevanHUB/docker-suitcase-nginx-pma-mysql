<?php

namespace Database\Factories;

use App\Models\Publica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PublicaFactory extends Factory
{
    protected $model = Publica::class;

    protected $table = 'publican';
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_usuario' => rand(11, 15),
            'id_publicacion' => rand(1, 5)
        ];
    }
}
