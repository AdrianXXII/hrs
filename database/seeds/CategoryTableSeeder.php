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
                  'description' => 'Standardzimmer für Familien (4 Personen)',
                  'number_of_beds' => 4,
                  'active' => 1),
            array('name' => 'Familienzimmer+',
                  'description' => 'Standardzimmer für Familien (5 Personen)',
                  'number_of_beds' => 5,
                  'active' => 1),
            array('name' => 'Standardzimmer',
                  'description' => 'Standardzimmer für zwei Personen',
                  'number_of_beds' => 2,
                  'active' => 1),
            array('name' => 'Single Zimmer',
                  'description' => 'Zimmer für eine Person',
                  'number_of_beds' => 1,
                  'active' => 1),
            array('name' => 'Luxus Zimmer',
                  'description' => 'Luxus Zimmer für zwei Personen mit Extras',
                  'number_of_beds' => 2,
                  'active' => 1),
            array('name' => 'Deluxe Zimmer',
                  'description' => 'Deluxe Zimmer für zwei Personen mit Extras',
                  'number_of_beds' => 2,
                  'active' => 1),
        );

        DB::table('categories')->insert($data);
    }
}
