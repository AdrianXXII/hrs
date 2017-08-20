<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Familienzimmer',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 4,
                  'active' => 1),
            array('name' => 'Familienzimmer+',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 5,
                  'active' => 1),
            array('name' => 'Standardzimmer',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 2,
                  'active' => 1),
            array('name' => 'Single Zimmer',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 1,
                  'active' => 1),
            array('name' => 'Luxus Zimmer',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 2,
                  'active' => 1),
            array('name' => 'Deluxe Zimmer',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed.',
                  'number_of_beds' => 2,
                  'active' => 1),
        );

        DB::table('categories')->insert($data);
    }
}
