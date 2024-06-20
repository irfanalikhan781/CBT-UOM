<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use faker as faker;
use App\Models\Mcq;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mcq>
 */
class McqFactory extends Factory
{
    protected $model = Mcq::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(),
            'options' => json_encode([$this->faker->word(), $this->faker->word(), $this->faker->word(), $this->faker->word()]),
            'answer' => $this->faker->randomElement(['Option1', 'Option2', 'Option3', 'Option4']),
            'course_id' => $this->faker->numberBetween(1, 3), // Assuming course IDs range from 1 to 3
            'department_id' => $this->faker->numberBetween(1, 7),
            // Add more attributes as necessary
        ];
    }
}
