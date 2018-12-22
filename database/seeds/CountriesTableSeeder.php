<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Country::insert([
            [
                'name' =>'Colombia'
            ],
            [
                'name' => 'Argentina'
            ]
        ]);
    }
}
