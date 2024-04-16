<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Packages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::all();
        $faker = Faker::create();
        for($i =0 ;$i < 1000 ; $i++){
            $country = $countries->random()->id;

            $amenite = collect(
                ['bell', 'group', 'location', 'support', 'wifi']
            );
            $syriaCountry = $this->getSyriaData($country);
            if($syriaCountry){
                $package_type = 'Internal';
            }else{
                $package_type = 'External';
            }

            $itinerary_Day = collect();
            $itinerary_title = collect();
            $itinerary_desc = collect();
             for ($day = 1; $day < $days = rand(3, 10); $day++) {
                $itinerary_Day->push('Day ' . $day);
                $itinerary_title->push($faker->sentence(4));
                $itinerary_desc->push($faker->paragraph(3));
            }

            $sentence = $faker->sentence;
            $packagePrice = rand(100, 1000);
            $offerPrice = rand(0, $packagePrice - 1); // Ensure offer price is less than flight price
            $discount = $packagePrice - $offerPrice;
            $discountPercentage = ($discount / $packagePrice) * 100;
            $data = [
               'name'=> $sentence,
               'slug'=> Str::slug($sentence),
               'days' => $days,
               'package_type' => $package_type,
               'description_small'=>  $faker->paragraph(3),
               'description_full'=>  $faker->paragraph(12),
               'loca_country' => $this->getCountry($country),
               'loca_city' => $this->getCityByCountry($country),
               'amenities_title'=> $amenite ,
               'amenities_icon'=>  [
                'uploade/amenities/bell.png',
                'uploade/amenities/group.png',
                'uploade/amenities/location.png',
                'uploade/amenities/support.png',
                'uploade/amenities/wifi.png',
               ],
               'itinerary_Day' => $itinerary_Day,
               'itinerary_title' => $itinerary_title,
               'itinerary_desc' => $itinerary_desc,
               'map'=> 'https://maps.google.com/maps?q=' . rand(1, 100) . ',' . rand(1, 100),
               'price'=> $packagePrice,
               'offer_price'=> $offerPrice,
               'discound'=> $discountPercentage,
               'image'=> 'uploade/packages/package'. rand(1, 59) .'.jpg',
               'gallery'=> [
                        'uploade/packages/package'. rand(1, 59) .'.jpg',
                        'uploade/packages/package'. rand(1, 59) .'.jpg',
                        'uploade/packages/package'. rand(1, 59) .'.jpg',
                        'uploade/packages/package'. rand(1, 59) .'.jpg',
                        'uploade/packages/package'. rand(1, 59) .'.jpg',
               ],
               'status'=> '1',
            ];

            $packageData = new Package($data);
            $packageData->save();
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
        return Country::where('id', $country_id)->value('id');
    }
    private function getSyriaData($country_id)
    {
        $data= Country::where('id', $country_id)->value('id');
        if ($data = '235'){
            return $data;
        }
    }
}
