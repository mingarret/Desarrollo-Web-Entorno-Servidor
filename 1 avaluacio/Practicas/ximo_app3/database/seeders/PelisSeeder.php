<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelis;

class PelisSeeder extends Seeder
{
    public function run()
    {
        Pelis::factory(10)->create(); // Generar 10 registros aleatorios
    }
}
