<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Front End'
        ]);
        Categoria::create([
            'nombre' => 'Back End'
        ]);
        Categoria::create([
            'nombre' => 'Full Stack'
        ]);
        Categoria::create([
            'nombre' => 'DevOps'
        ]);
        Categoria::create([
            'nombre' => 'DBA'
        ]);
        Categoria::create([
            'nombre' => 'UX / UI'
        ]);
        Categoria::create([
            'nombre' => 'Teachleas'
        ]);
    }
}
