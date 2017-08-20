<?php

use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('description' => 'Parkplatz', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Zimmerservice', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Haustiere erlaubt', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Flughafenshuttle', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Restaurant', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Behindertenfreundlich', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'WLAN inklusive', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Fitnesscenter', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Spa & Wellnesscenter', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Swimming Pool', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Spielplatz', 'hotel_atr' => 1, 'active' => 1),
            array('description' => 'Aussicht', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Badewanne', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Flachbild-TV', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Kaffee- und Teezubehör', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Kaffeemaschine', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Klimaanlage', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Küche/Kochnische', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Arbeitstisch', 'hotel_atr' => 0, 'active' => 1),
            array('description' => 'Zimmertelefon', 'hotel_atr' => 0, 'active' => 1)
        );

        DB::table('attributes')->insert($data);
    }
}
