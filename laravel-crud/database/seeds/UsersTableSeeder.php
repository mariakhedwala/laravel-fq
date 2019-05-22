<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ajinkya',
            'job_title' => 'Web Developer',
            'country' => 'India',
            'city' => 'Mumbai',
            'email' => 'ajinkyapatil.p@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
