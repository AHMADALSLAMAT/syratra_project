<?php

namespace App\Helpers;

use App\Models\Flight;
use function PHPUnit\Framework\isEmpty;

class FlightSearch
{

    public static function getFlightBasedOnTravelDate(
        $trip_type,
        $flight_leave_airport,
        $flight_arrive_airport,
        $flight_leave_date,
        $flight_return_date
    ) {
        // if the user wants to go and back from the trip multiways
        if ($trip_type == 'rounded') {
            $searchResults = self::getRoundTripFlights(
                $flight_leave_airport,
                $flight_arrive_airport,
                $flight_leave_date,
                $flight_return_date
            );
            return $searchResults;
        }
        if (empty($allFlights) || $allFlights == null) {
            $allFlights = 'there is not data for your request';
        }
        //// if the user wants to go and back from oneway
        //if($trip_type == 'oneway'){
        //    $allFlights = self::getFlightsBasedOnConditions(
        //        $flight_leave_airport,
        //        $flight_arrive_airport,
        //        $flight_leave_date
        //    );
        //    return $allFlights;
        //}
    }

    private static function getRoundTripFlights(
        $leaveAirport,
        $arriveAirport,
        $leaveDate,
        $returnDate
    ) {
        // Search for round-trip flights with the same airlines
        $roundTripFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])
            ->where([
                ['flight_leave_airport', '=', $leaveAirport],
                ['flight_arrive_airport', '=', $arriveAirport],
                ['flight_leave_date', '=', $leaveDate],
            ])->get();
        // Convert the array to a Laravel Collection
        $relatedFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->take(10)->get();
        // card flight with return airport
        // Get all flights that return from the destination airport to the departure airport
        // Get all flights that return from the destination airport to the departure airport

        foreach ($roundTripFlights as $flight) {

            // Get return flight with the same airline
            $returnFlight = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                ['flight_leave_airport', '=', $flight->flight_arrive_airport],
                ['flight_arrive_airport', '=', $flight->flight_leave_airport],
                ['flight_leave_date', '>=', $returnDate],
                ['airline_id', '=', $flight->airline_id],
                ])->get();

                if ($returnFlight->isNotEmpty()) {
                    return collect([
                            'departure_flight' => $flight,
                            'return_flight' => $returnFlight,
                            'related_flights' => $relatedFlights,
                            'isRoundTrip' => true, // Indicate that this is not a round-trip
                    ]);
                }

                    // Get related flights with different airlines
                if ($returnFlight->isEmpty()) {
                    $returnFlight = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                            ['flight_leave_airport', '=', $flight->flight_arrive_airport],
                            ['flight_arrive_airport', '=', $flight->flight_leave_airport],
                            ['flight_leave_date', '>=', $flight->flight_arrive_date],
                            ['airline_id', '!=', $flight->airline_id],
                        ])->get();

                        if ($returnFlight->isNotEmpty()) {
                            return collect([
                                'departure_flight' => $flight,
                                'return_flight' => $returnFlight,
                                'related_flights' => $relatedFlights,
                                'isRoundTrip' => true, // Indicate that this is not a round-trip
                            ]);
                    }
                } else {


                    // If no return flight with the same airline, get all return flights with different airlines
                        $returnFlight = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                            ['flight_leave_airport', '=', $flight->flight_arrive_airport],
                            ['flight_arrive_airport', '=', $flight->flight_leave_airport],
                            ['flight_leave_date', '>=', $flight->flight_arrive_date],
                        ])->get();
                        if ($returnFlight->isNotEmpty()) {
                            return collect([
                                'departure_flight' => $returnFlight->isEmpty() ? null : $returnFlight,
                                'related_flights' => $relatedFlights,
                                'isRoundTrip' => true, // Indicate that this is not a round-trip
                            ]);
                    }

                }
            }
        // If no round-trip flights with the same airlines, get one-way flights
        // card flight without return  with same airline data
        if ($roundTripFlights->isEmpty()) {
            $leaveFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                    ['flight_leave_airport', '=', $leaveAirport],
                    ['flight_arrive_airport', '=', $arriveAirport],
                    ['flight_leave_date', '=', $leaveDate],
                ])->get();

            // Convert the array to a Laravel Collection
            $leaveFlights = collect($leaveFlights);
            $relatedFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->take(10)->get();

            // If return flight date doesn't match, get advanced date options
            if ($leaveFlights->isNotEmpty() && $leaveFlights[0]->flight_leave_date != $returnDate) {
                $returnFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])    ->where([
                        ['flight_leave_airport', '=', $arriveAirport],
                        ['flight_arrive_airport', '=', $leaveAirport],
                        ['flight_leave_date', '=', $returnDate],
                    ])->get();
                $relatedFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->take(10)->get();

                // Return a direct collection with the desired structure
                return collect([
                    'departure_flight' => $leaveFlights,
                    'returnFlights' => $returnFlights,
                    'isRoundTrip' => false, // Indicate that this is not a round-trip
                    'related_flights' => $relatedFlights,
                ]);
            }
        }
        // card flight without return  with same airline diffrent data
        // Additional cases with related flights
        if ($roundTripFlights->isEmpty()) {
            $leaveFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                    ['flight_leave_airport', '=', $leaveAirport],
                    ['flight_arrive_airport', '=', $arriveAirport],
                ])->get();
            $relatedFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->take(10)->get();

            // Return a direct collection with the desired structure
            return collect([
                'departure_flight' => $leaveFlights,
                'related_flights' => $relatedFlights,
                'isRoundTrip' => false, // Indicate that this is not a round-trip
            ]);
        }
        // card flight without return  with same airline diffrent data and arrive airport
        if ($roundTripFlights->isEmpty()) {
            $leaveFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->where([
                    ['flight_leave_airport', '=', $leaveAirport],
                ])->get();
            $relatedFlights = Flight::with(['airlines','departureAirport','arrivalAirport'])->take(10)->get();

            // Return a direct collection with the desired structure
            return collect([
                'departure_flight' => $leaveFlights,
                'related_flights' => $relatedFlights,
                'isRoundTrip' => false, // Indicate that this is not a round-trip
            ]);

        }
        return collect([
            'departure_flight' => $roundTripFlights,
            'related_flights' => $relatedFlights,
            'isRoundTrip' => false, // Indicate that this is not a round-trip
        ]);
    }

}
