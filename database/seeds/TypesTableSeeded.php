<?php

use Illuminate\Database\Seeder;

class TypesTableSeeded extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('types')->insert([
        	'name' => 'Standard',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('types')->insert([
        	'name' => 'System',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);         

    }
}
