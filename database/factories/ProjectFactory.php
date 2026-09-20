<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company().'电气工程项目',
            'code' => strtoupper(fake()->unique()->bothify('PRJ-####')),
            'customer_name' => fake()->company(),
            'manager_name' => fake()->name(),
            'location' => fake()->city(),
            'status' => fake()->randomElement(['draft', 'pending', 'started', 'finished']),
            'start_date' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'end_date' => fake()->optional()->dateTimeBetween('now', '+6 months'),
            'budget_amount' => fake()->randomFloat(2, 10000, 500000),
            'description' => fake()->sentence(),
            'remark' => fake()->optional()->sentence(),
        ];
    }
}
