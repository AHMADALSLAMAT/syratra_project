<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiAccess;
use App\Helpers\apiGetData;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;

class FlightController extends Controller
{

    // get the flights based on city or airport to search
    public function SearchFormData(Request $request, Client $client)
{
    $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

    // Check if it's a POST request and get data accordingly
    if ($request->isMethod('post')) {
        $data = $request->all(); // Adjust this based on your actual form data
        $data = [
            'originLocationCode' => $data['flight_leave_country'],
            'destinationLocationCode' => $data['flight_arrive_country'],
            'departureDate' => $data['flight_leave_date'],
            'adults' => $data['number_of_adults']
        ];
    } else {
        // If it's a GET request, use your default data
        $data = [
            'originLocationCode' => 'PAR',
            'destinationLocationCode' => 'LON',
            'departureDate' => date('Y-m-d', strtotime('+1 day')),
            'adults' => 1
        ];
    }
    // Build the query parameters

    $data = http_build_query($data);
    $url .= '?' . $data;
    try {
        $apiAccess = new ApiAccess(); // Instantiate the ApiAccess class
        $accessToken = $apiAccess->access_token($client); // Call the method on the instance
        $response = $client->get($url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' .$accessToken
            ],
        ]);
        $apiResponse = json_decode($response->getBody(), true);
        $result= apiGetData::processFlightData($apiResponse);
        // Pass the API response to the Blade view
        return view('Front_End.pages.flights.flight_search_data', ['result' => $result]);

    } catch (GuzzleException $exception) {
        dd($exception);
    }
}


// get the api city or airport to search
public function getAirportOrCity(Request $request, Client $client)
{
    $data = $request->input();
    $url = "https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY,AIRPORT&keyword=".$data['keyword'];
    try {
        $apiAccess = new ApiAccess(); // Instantiate the ApiAccess class
        $accessToken = $apiAccess->access_token($client); // Call the method on the instance
        $response = $client->get($url, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' .$accessToken
            ],
        ]);
        $apiResponse = json_decode($response->getBody(), true);
        // Pass the API response to the Blade view
        return  $apiResponse ;
    } catch (GuzzleException $exception) {
        dd($exception);
    }
}
}
