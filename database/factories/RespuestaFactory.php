<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RespuestaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'desRespuesta' => $this->faker->text(rand(10, 500)),
            'correcta' => 0,
            'activo' => 1
        ];
    }
}
