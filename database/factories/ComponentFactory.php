<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Component;
use App\Models\ComponentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => fn (): int => Brand::query()->inRandomOrder()->value('id') ?? Brand::factory()->create()->id,
            'component_category_id' => fn (): int => ComponentCategory::query()->inRandomOrder()->value('id') ?? ComponentCategory::factory()->create()->id,
            'name' => fake()->randomElement(['空气开关', '交流接触器', '控制电缆', '热继电器', '端子排']).fake()->numerify('##'),
            'unit' => fake()->randomElement(['个', '扎', '米', '袋', '台', '箱']),
            'power_consumption' => fake()->optional()->randomFloat(2, 0.5, 5000),
            'version' => fake()->optional()->bothify('V#.#'),
            'code' => fake()->optional()->passthrough(strtoupper(fake()->bothify('CP-###??'))),
            'unit_price' => fake()->randomFloat(2, 1, 5000),
            'url' => fake()->optional()->url(),
        ];
    }
}
