<?php

namespace Database\Factories;

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-1 week');
        $end_date = $this->faker->dateTimeBetween($start_date, '+1 week');

        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'color' => $this->faker->hexColor,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'done' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deleted_at' => null,
        ];
    }
}


