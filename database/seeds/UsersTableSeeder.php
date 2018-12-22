<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Angel Kurten',
            'email' => 'angelkurten@hotmail.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
