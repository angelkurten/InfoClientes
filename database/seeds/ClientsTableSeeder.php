<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Client::create([
            'nit' => '1234',
            'name' => 'Angel Kurten',
            'direction' => 'Avenida Siempre Viva',
            'telephone' => '555555',
            'city_id' => 1,
            'quota' => 10000,
            'balance_quota' => 0,
            'percentage_visits' => 3,
        ]);
    }
}
