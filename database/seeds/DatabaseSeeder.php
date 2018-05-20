<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesTableSeeded::class);
        $this->call(RolesTableSeeded::class);  
        $this->call(UsersTableSeeder::class);               
    }
}
