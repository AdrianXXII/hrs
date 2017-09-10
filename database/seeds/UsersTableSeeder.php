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
        $data = array([
            'name' => "hrs-manager",
            'firstname' => 'Manager',
            'lastname' => 'Hotel',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'group_id' => 2,
            'active' => 1],[
            'name' => "hrs-angestellte",
            'firstname' => 'Angestellter',
            'lastname' => 'Hotel',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'group_id' => 3,
            'active' => 1]
        );
        DB::table('users')->insert($data);
    }
}
