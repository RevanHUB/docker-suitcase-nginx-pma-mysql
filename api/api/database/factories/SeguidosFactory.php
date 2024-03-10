<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seguido;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SeguidosFactory extends Factory
{

    protected $model = Seguido::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_seguidor' => rand(6,10),
            'id_seguido' => rand(11,15)
        ];
    }
}
