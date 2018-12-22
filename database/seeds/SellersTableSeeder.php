<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Seller::create([
            'name' => 'Vendedor 1',
        ]);
        \App\Seller::create([
            'name' => 'Vendedor 2',
        ]);
        \App\Seller::create([
            'name' => 'Vendedor 3',
        ]);
    }
}
