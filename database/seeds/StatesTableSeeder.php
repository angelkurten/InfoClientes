<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\State::insert([
            [
                'name' => 'Cesar',
                'country_id' => 1,
            ],
            [
                'name' => 'Antioquia',
                'country_id' => 1,
            ],
            [
                'name' => 'Buenos Aires',
                'country_id' => 2,
            ],
            [
                'name' => 'Santa Fe',
                'country_id' => 2,
            ],
        ]);
    }
}
