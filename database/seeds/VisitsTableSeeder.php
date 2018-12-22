<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Visit::create([
            'client_id' => 1,
            'visit_at' => \Carbon\Carbon::now(),
            'seller_id' => 1,
            'value_net' => 10,
            'value_visit' => 1,
            'observations' => 'None'
        ]);
    }
}
