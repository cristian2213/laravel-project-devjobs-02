<?php

use App\Experiencia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ExperienciasSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UbicacionSeeder::class);
        $this->call(SalariosSeeder::class);
    }
}
