<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class Flightseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = Airline::all();
        $airports = Airport::all();
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            $leaveCountry = $airports->random()->countryName;
            $arriveCountry = $airports->random()->countryName;
            if ($arriveCountry == 'SYRIA' && $leaveCountry == 'SYRIA') {
                $travel_type = 'Internal';
            } else {
                $travel_type = 'External';
            }
            // Generate random values for flight price and offer price
            $flightPrice = rand(100, 1000);
            $offerPrice = rand(50, $flightPrice - 1); // Ensure offer price is less than flight price
            $discount = $flightPrice - $offerPrice;
            $discountPercentage = ($discount / $flightPrice) * 100;
            $leaveDate = Carbon::now()->addDays(rand(1, 30));
            $leaveHours = sprintf('%02d:%02d', rand(0, 23), rand(0, 59));
            $data = [
                'airline_id' => $airlines->random()->id,
                'flight_name' => Str::random(7),
                'flight_sku' => Str::random(8),
                'flights_seats' => rand(1, 200),
                'travel_type' => $travel_type,
                'flight_type' => collect(['economy', 'business', 'first_class', 'premium_economy'])->random(),
                'flight_leave_date' => $leaveDate->toDateString(),
                'flight_leave_hours' => $leaveHours,
                'flight_leave_country' => $leaveCountry,
                'flight_leave_airport' => $this->getAirportCode($leaveCountry),
                'flight_arrive_date' => $leaveDate->copy()->addHours(rand(1, 48))->toDateString(),
                'flight_arrive_hours' => $this->getArriveHours($leaveHours),
                'flight_arrive_country' => $arriveCountry,
                'flight_arrive_airport' => $this->getAirportCode($arriveCountry),
                'flight_stops' => rand(0, 1),
                'flight_stops_country' => [],
                'flight_stops_airport' => [],
                'flight_stops_date' => [],
                'flight_stops_hours' => [],
                'flight_price' => $flightPrice,
                'offer_price' => $offerPrice,
                'discound' => $discountPercentage,
                'flight_status' => 1,
                'return_flight' => rand(0, 1),
                'flight_amenities_title' => [Str::random(5), Str::random(5)],
                'flight_amenities_icon' => ['icon1.png', 'icon2.png'],
            ];
            // Fill in flight stops data if applicable
            if ($data['flight_stops']) {
                $numStops = rand(1, 3);
                $data['flight_stops_country'] = $this->getRandomCountries($leaveCountry, $numStops);
                $data['flight_stops_airport'] = $this->getRandomAirports($numStops);
                $data['flight_stops_date'] = $this->getRandomDates($leaveDate, $data['flight_arrive_date'], $numStops);
                $data['flight_stops_hours'] = $this->getRandomHours($leaveHours, $data['flight_arrive_hours'], $numStops);
            }

            $this->insertFlight($data);
        }
    }

    private function getAirportCode($country)
    {
        $airport = Airport::where('countryName', $country)->inRandomOrder()->first();
        return $airport ? $airport->code : null;
    }

    private function getArriveHours($leaveHours)
    {
        $leaveTime = Carbon::parse($leaveHours);
        $arriveTime = $leaveTime->copy()->addHours(rand(1, 48));
        return $arriveTime->format('H:i');
    }

    private function getRandomCountries($leaveCountry, $num)
    {
        $countries = Airport::where('countryName', '!=', $leaveCountry)->pluck('countryName')->shuffle()->take($num)->toArray();
        return $countries;
    }

    private function getRandomAirports($num)
    {
        $airports = Airport::pluck('code')->shuffle()->take($num)->toArray();
        return $airports;
    }

    private function getRandomDates($leaveDate, $arriveDate, $num)
    {
        $dates = [];

        for ($i = 0; $i < $num; $i++) {
            $dates[] = $leaveDate->copy()->addDays(rand(1, Carbon::parse($arriveDate)->diffInDays($leaveDate)));
        }

        return $dates;
    }

    private function getRandomHours($leaveHours, $arriveHours, $num)
    {
        $leaveHoursNumeric = Carbon::parse($leaveHours)->format('G'); // Convert to 24-hour format
        $arriveHoursNumeric = Carbon::parse($arriveHours)->format('G'); // Convert to 24-hour format

        $hours = [];

        for ($i = 0; $i < $num; $i++) {
            $hours[] = $leaveHoursNumeric + rand(1, $arriveHoursNumeric - $leaveHoursNumeric);
        }

        return $hours;
    }
    private function insertFlight($data)
    {
        $flight_data = new Flight($data);
        $flight_data->save();
    }
}
