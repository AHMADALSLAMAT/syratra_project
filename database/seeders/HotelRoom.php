<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Hotelroom as ModelsHotelroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class HotelRoom extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = Hotel::all();
        $faker = Faker::create();
        foreach($hotels as $hotel){
            for ($i = 0; $i < $hotel->hotel_rooms; $i++) {
                $roomType = collect(
                    ['Single room', 'Connecting rooms', 'Studio', 'Double room', 'Deluxe Room']
                    )->random();
                    $amenite = collect(
                        ['bell', 'group', 'location', 'support', 'wifi']
                    );
                // Determine room beds and num of rooms based on room type
                switch ($roomType) {
                    case 'Single room':
                        $roomBeds = 1;
                        $numOfRooms = 1;
                        break;
                    case 'Connecting rooms':
                        // Define logic for connecting rooms
                        $roomBeds = 2; // Adjust as needed
                        $numOfRooms = 4; // Adjust as needed
                        break;
                    case 'Studio':
                        $roomBeds = 1;
                        $numOfRooms = 2;
                        break;
                    case 'Double room':
                        $roomBeds = 2;
                        $numOfRooms = 3;
                        break;
                    case 'Deluxe Room':
                        // Define logic for deluxe room
                        $roomBeds = 3; // Adjust as needed
                        $numOfRooms = 6; // Adjust as needed
                        break;
                    default:
                        $roomBeds = 1;
                        $numOfRooms = 1;
                }
                $hotelPrice = rand(100, 1000);
                $offerPrice = rand(50, $hotelPrice - 1); // Ensure offer price is less than flight price
                $discount = $hotelPrice - $offerPrice;
                $discountPercentage = ($discount / $hotelPrice) * 100;
                $data = [
                    'hotel_id' =>$hotel->id,
                    'booking_id' =>'0',
                    'room_description' =>$faker->paragraph(5),
                    'room_amenities_title' => $amenite,
                    'room_amenities_icon' =>[
                        'uploade/amenities/bell.png',
                         'uploade/amenities/group.png',
                         'uploade/amenities/location.png',
                         'uploade/amenities/support.png',
                         'uploade/amenities/wifi.png',
                    ],
                    'room_price' => $hotelPrice,
                    'offer_price' => $offerPrice,
                    'discound' => $discountPercentage,
                    'room_beds' =>$roomBeds,
                    'num_of_rooms' =>$numOfRooms,
                    'room_image' =>  'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    'room_lvl' =>'Floor'.rand(1,40),
                    'room_type' =>$roomType,
                    'room_gallery' => [
                        'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                        'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                        'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                        'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                        'uploade/hotel/hotel'. rand(1, 50) .'.webp',
                    ],
                    'room_status' =>'1',
                ];
                // Create room using eloquent relationship
                $flight_data = new ModelsHotelroom($data);
                $flight_data->save();
            }

        }
    }
}
