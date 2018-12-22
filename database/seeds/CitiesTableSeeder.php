<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\City::insert([
            [
                'name' => 'Valledupar',
                'state_id' => 1,
            ],
            [
                'name' => 'Aguachica',
                'state_id' => 1,
            ],
            [
                'name' => 'Medellin',
                'state_id' => 2,
            ],
            [
                'name' => 'Rionegro',
                'state_id' => 2,
            ],
            [
                'name' => 'La Plata',
                'state_id' => 3,
            ],
            [
                'name' => 'Buenos Aires',
                'state_id' => 3,
            ],
            [
                'name' => 'Rosario',
                'state_id' => 4,
            ],
        ]);
    }
}
