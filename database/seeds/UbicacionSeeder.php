<?php

use App\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ubicacion::create([
            'nombre' => 'Remoto'
        ]);

        Ubicacion::create([
            'nombre' => 'USA'
        ]);

        Ubicacion::create([
            'nombre' => 'Canada'
        ]);

        Ubicacion::create([
            'nombre' => 'Mexico'
        ]);

        Ubicacion::create([
            'nombre' => 'Colombia'
        ]);

        Ubicacion::create([
            'nombre' => 'Argentina'
        ]);

        Ubicacion::create([
            'nombre' => 'España'
        ]);
    }
}
