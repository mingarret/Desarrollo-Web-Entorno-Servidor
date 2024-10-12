<?php

namespace Database\Factories;

use App\Models\Pelis;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelisFactory extends Factory
{
    protected $model = Pelis::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'año' => $this->faker->year(),
        ];
    }
}
