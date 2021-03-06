<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PreguntaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'desPregunta' => $this->faker->text(rand(0, 500)),
            'activo' => 1
        ];
    }
}
