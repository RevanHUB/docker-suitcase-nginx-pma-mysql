<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;
    public static $pos = 0;
    public static $roles = [
        'admin', 'ayuntamiento', 'comercio', 'particular'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        RoleFactory::$pos++;
        return [];
    }
}
