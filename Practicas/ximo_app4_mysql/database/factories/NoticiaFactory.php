<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Noticia;

class NoticiaFactory extends Factory
{
    // Define el modelo que este factory creará
    protected $model = Noticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'resumen' => $this->faker->paragraph,
            'cuerpo' => $this->faker->paragraphs(5, true),
        ];
    }
}
