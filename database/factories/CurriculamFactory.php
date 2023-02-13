<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'week_day' => 'sunday',
            'class_time' => $this->faker->time,
            'end_date' => $this->faker->date,
            'course_id' => 1,
        ];
    }
}
