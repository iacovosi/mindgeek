<?php

use Illuminate\Database\Seeder;

class RolesTableSeeded extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('roles')->insert([
            'name' => 'Admin',
            'isAdminRole'=>1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('roles')->insert([
        	'name' => 'Reqular',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);        
    }
}
