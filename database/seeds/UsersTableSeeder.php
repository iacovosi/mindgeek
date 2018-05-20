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
        //
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@mindgeek.com',
            'role_id' => 1,
            'password' => '$2y$10$CZjRrN.bKQ1v1wE39Xw7dOc7azlHWvJFpfgnTvDZMuEO9QlzBcT36',
            'remember_token' =>'AJ0i8LLw4Pp6OIuuRrBGt88moKYlRPv0M8xywmW7Khn0AXCmNuKzidb8aI5n',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]); 
        //
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@chat.com',
            'role_id' => 1,
            'password' => bcrypt('test'),
            'remember_token' =>'test',
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);                 
    }
}
