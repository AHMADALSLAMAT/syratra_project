<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel as ModelsHotel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class Hotel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesid = Country::get();

        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $country = $countriesid->random()->id;

            $amenite = collect(
                ['bell', 'group', 'location', 'support', 'wifi']
            );
            $syriaCountry = $this->getSyriaData($countriesid);
            if($syriaCountry == 'Internal'){
                $hotel_type = 'Internal';
            }else{
                $hotel_type = 'External';
            }
            $data = [
                'hotel_name' => 'Random Title Hotel ' . ($i + 1),
                'slug' => Str::slug('Random Title Hotel ' . ($i + 1)),
                'hotel_description_small' => $faker->paragraph(3),
                'hotel_description_full' => $faker->paragraph(7),
                'loca_country' => $this->getCountry($country),
                'loca_city' => $this->getCityByCountry($country),
                'hotel_amenities_title' => $amenite,
                'hotel_amenities_icon' => [
                        'uploade/amenities/bell.png',
                        'uploade/amenities/group.png',
                        'uploade/amenities/location.png',
                        'uploade/amenities/support.png',
                        'uploade/amenities/wifi.png',
                ],
                'hotel_map' => 'https://maps.google.com/maps?q=' . rand(1, 100) . ',' . rand(1, 100),
                'hotel_rooms' => mt_rand(1, 20),
                'hotel_image' =>   'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                'hotel_gallery' => [
                    'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                ],
                'hotel_status' => 1,
                'hotel_type' =>  $hotel_type,
            ];

            $flight_data = new ModelsHotel($data);
            $flight_data->save();
        }
    }

    private function getCityByCountry($country_id){
        // Get all cities for the specified country
        $cities = City::where('country_id', $country_id)->pluck('id');

        // Check if there are any cities
        if($cities->isEmpty()) {
            return 'No cities found for the given country';
        }

        // Get a random city from the list
        return $cities->random();
    }
    private function getCountry($country_id){
        $contriesdata = Country::where('id', $country_id)->pluck('id');

         // Check if there are any cities
         if($contriesdata->isEmpty()) {
            return 'No Country found for the given id';
        }

        // Get a random city from the list
        return $contriesdata->random();
    }
    private function getSyriaData($country_id)
    {

        if ($country_id == '235'){
            return 'Internal';
        }else{
            return 'External';
        }
    }
}
