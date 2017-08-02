<?php

use Illuminate\Database\Seeder;

class PhotographyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photography_types')->insert([
        	['type' => 'landscape'],
        	['type' => 'portrait'],
        	['type' => 'wildlife']
        ]);
    }
}
