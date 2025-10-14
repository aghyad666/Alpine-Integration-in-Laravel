<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'type' => fake()->randomElement(['income', 'expense']),
            'parent_id' => null,
        ];
    }

    /**
     * State for category without parent_id (always null = 'root' in tree hierarchy).
     * NOTE: Used in seeder.
     */
    public function rootCategory(): static
    {
        return $this->state(fn () => ['parent_id' => null]);
    }

    /**
     * Type sent in seeder.
     */
    public function type(string $type): static
    {
        return $this->state(fn () => ['type' => $type]);
    }
}
