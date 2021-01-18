<?php

use App\Salario;
use Illuminate\Database\Seeder;

class SalariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salario::create([
            'nombre' => '0 - 1000 USD'
        ]);

        Salario::create([
            'nombre' => '1000 - 2000 USD'
        ]);

        Salario::create([
            'nombre' => '2000 - 4000 USD'
        ]);

        Salario::create([
            'nombre' => 'No Mostrar'
        ]);
    }
}
