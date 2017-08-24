<?php

use Illuminate\Database\Seeder;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Hotel Schweiz',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 4,
                  'street' => 'Seestrasse 1',
                  'postalcode' => '3000',
                  'area' => 'Bern',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'hotelschweiz@example.com',
                  'active' => 1),
            array('name' => 'Hotel Sterne',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 5,
                  'street' => 'Sternstrasse 1',
                  'postalcode' => '4500',
                  'area' => 'Solothurn',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'hotelsterne@example.com',
                  'active' => 1),
            array('name' => 'Hotel Burghof',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 3,
                  'street' => 'Burgstrasse 10',
                  'postalcode' => '4500',
                  'area' => 'Solothurn',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'hotelsterne@example.com',
                  'active' => 1),
            array('name' => 'Berner Hotel',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 5,
                  'street' => 'Feldstrasse 8',
                  'postalcode' => '3000',
                  'area' => 'Bern',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'bernerhotel@example.com',
                  'active' => 1),
            array('name' => 'Aare Mürli',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 3,
                  'street' => 'Mürlistrasse 1',
                  'postalcode' => '1212',
                  'area' => 'Graubünden',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'aaremuerli@example.com',
                  'active' => 1),
            array('name' => 'Graubünden Berghotel',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 5,
                  'street' => 'Bergstrasse 10',
                  'postalcode' => '1212',
                  'area' => 'Graubünden',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'berghotel@example.com',
                  'active' => 1),
            array('name' => 'Seeblick Hotel',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 4,
                  'street' => 'An der See 22',
                  'postalcode' => '6000',
                  'area' => 'Zürich',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'seeblick@example.com',
                  'active' => 1),
            array('name' => 'Villa Hotel',
                  'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                  'stars' => 3,
                  'street' => 'Bergweg 12',
                  'postalcode' => '7278',
                  'area' => 'Davos',
                  'telephone' => '0123456789',
                  'fax' => '0123456788',
                  'email' => 'villahotel@example.com',
                  'active' => 1),
        );

        DB::table('hotels')->insert($data);
    }
}
