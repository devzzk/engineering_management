<?php

namespace Database\Factories;

use App\Models\ComponentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ComponentCategory>
 */
class ComponentCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['配电', '控制', '线缆', '保护', '连接']).fake()->numerify('##'),
            'description' => fake()->sentence(),
            'remark' => fake()->optional()->sentence(),
        ];
    }
}
