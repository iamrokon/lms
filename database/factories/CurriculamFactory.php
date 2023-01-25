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
            'name' => $this->faker->paragraph,
            'course_id' => 1,
        ];
    }
}
