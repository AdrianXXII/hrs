<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        DB::table('users')->insert([
            'name' => "Admin",
            'firstname' => 'Admin',
            'lastname' => '',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'group_id' => 1,
            'active' => 1
        ]);
    }
}
