<?php

namespace App\Helpers;

use Carbon\Carbon;
use GuzzleHttp\Client;

class apiGetData {

    public static function processFlightData($apiData)
    {
        $processedData = [];

        foreach ($apiData['data'] as $flightOffer) {
            $processedFlight = [
                'type' => $flightOffer['type'],
                'id' => $flightOffer['id'],
                'source' => $flightOffer['source'],
                'instantTicketingRequired' => $flightOffer['instantTicketingRequired'],
                'nonHomogeneous' => $flightOffer['nonHomogeneous'],
                'oneWay' => $flightOffer['oneWay'],
                'lastTicketingDate' => Flight::convertDate($flightOffer['lastTicketingDate']),
                'lastTicketingDateTime' => Flight::convertDate($flightOffer['lastTicketingDateTime']),
                'numberOfBookableSeats' => $flightOffer['numberOfBookableSeats'],
                'itineraries' => self::flattenSegments($flightOffer['itineraries']),
                'price' => $flightOffer['price'],
                'pricingOptions' => $flightOffer['pricingOptions'],
                'validatingAirlineCodes' => self::airlinename($flightOffer['validatingAirlineCodes']),
                'travelerPricings' => self::processTravelerPricings($flightOffer['travelerPricings']),
            ];

            $processedData[] = $processedFlight;
        }

        return $processedData;
    }

    public static function processTravelerPricings($travelerPricings)
    {
        $processedTravelerPricings = [];

        foreach ($travelerPricings as $travelerPricing) {
            $processedTraveler = [
                'travelerId' => $travelerPricing['travelerId'],
                'fareOption' => $travelerPricing['fareOption'],
                'travelerType' => $travelerPricing['travelerType'],
                'price' => $travelerPricing['price'],
                'fareDetailsBySegment' => $travelerPricing['fareDetailsBySegment'],
            ];

            $processedTravelerPricings[] = $processedTraveler;
        }

        return $processedTravelerPricings;
    }
    // get all segments of api flight
    public static function flattenSegments($itineraries)
    {
        $flattenedSegments = [];

            foreach ($itineraries as $itinerary) {
                foreach ($itinerary['segments'] as $key=> $segment) {
                    if (is_array($segment) && isset($segment['departure']['iataCode'])) {
                    $datasegments = [
                        "departureiataCode" => Self::getAirportOrCity($segment['departure']['iataCode']),
                        "departuredate" => Flight::convertDate($segment['departure']['at']),
                        "arrivaliataCode" => Self::getAirportOrCity($segment['arrival']['iataCode']),
                        "arrivaldate" => Flight::convertDate($segment['arrival']['at']),
                        "diffrenceHours" => Flight::calculateDifferenceHours(
                            $segment['departure']['at'], $segment['arrival']['at']
                        ),
                        "carrierCode" => Self::airlinename($segment['carrierCode']),
                        "number" => $segment['number'],
                        "aircraft" => $segment['aircraft']['code'],
                        "duration" => $segment['duration'],
                        "id" => $segment['id'],
                        "numberOfStops" => $segment['numberOfStops'],
                        "blacklistedInEU" => $segment['blacklistedInEU'],
                    ];
                    $flattenedSegments[]=$datasegments;
                }else{
                    $flattenedSegments[]=$segment;
                }
                }
            }

        return $flattenedSegments;
    }

    public static function airlinename($airlines)
    {
        // Assuming $client is properly defined and configured
        $client = new Client();
           // Assuming $client is properly defined and configured
           $client = new Client();
           $url = "https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=".$airlines;
           $apiAccess = new ApiAccess();
           sleep(1); // Adjust the sleep duration based on the rate limits
           $accessToken = $apiAccess->access_token($client);
           $response = $client->get($url, [
               'headers' => [
                   'Accept' => 'application/json',
                   'Authorization' => 'Bearer ' . $accessToken,
               ],
           ]);
           $apiResponse = json_decode($response->getBody(), true);

           return $apiResponse['data'];
    }
    public static function getAirportOrCity($iticode)
    {

        // Assuming $client is properly defined and configured
            $client = new Client();
            $url = "https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY,AIRPORT&keyword=" . $iticode;
            $apiAccess = new ApiAccess();
            sleep(1); // Adjust the sleep duration based on the rate limits

            $accessToken = $apiAccess->access_token($client);
            $response = $client->get($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
            $apiResponse = json_decode($response->getBody(), true);

            return $apiResponse['data'];
    }
}
