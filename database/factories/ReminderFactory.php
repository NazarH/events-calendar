<?php

namespace Database\Factories;

use App\Models\Reminder;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'color' => $this->faker->hexColor,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'regularity' => $this->faker->randomElement(['once', 'everyday', 'weekly', 'monthly']),
            'done' => 0,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deleted_at' => null,
        ];
    }
}

