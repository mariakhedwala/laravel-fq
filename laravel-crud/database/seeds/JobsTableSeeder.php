<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('job_titles')->insert(array(
    		array(
    			'job_title' => 'Web Developer',
    		),
    		array(
    			'job_title' => 'Business Development',
    		),
    	));
    }
}
