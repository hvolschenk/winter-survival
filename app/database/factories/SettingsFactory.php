<?php

namespace Database\Factories;

use App\Enums\Difficulty;
use App\Enums\Units;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settings>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'difficulty' => Difficulty::Medium->value,
            'units' => Units::Metric->value,
        ];
    }
}
