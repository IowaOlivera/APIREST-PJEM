<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'desAccion' => $this->faker->text(rand(15,45)),
            'activo' => 1
        ];
    }
}
