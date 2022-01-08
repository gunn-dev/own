<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarPhoneUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('users')->insert([
            'name' => '1875 Star Phone Admin',
            'email' => 'starphone@horo.com',
            'password' => bcrypt('h0r0@starph0n3'),
        ]);
    }
}
