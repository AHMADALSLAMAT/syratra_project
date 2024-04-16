<?php

namespace App\Http\Controllers\Front_End;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\Flight;
use App\Models\Cardsinfo;
use App\Models\Hotelroom;
use App\Helpers\MyFunctions;
use Illuminate\Http\Request;
use App\Mail\Userbookingemail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    // check if the user is registered or not if not back to login

    public function __construct()
    {
        $this->middleware('auth');
    }

    //Flights Booking
    public function flightbooking_post(Request $request)
    {
        $data = $request->all();
        if($data['departure_flight_id'] === $data['return_flight_id'])
        {
            $dataFlight = Flight::with(['airlines','departureAirport','arrivalAirport'])
            ->where('id',$data['return_flight_id'])->first();
            return response()->json(
        [
                 //this code here to send the data to booking controller passing throught ajax
                'redirect' => route('flightbooking', ['data' => json_encode($dataFlight),'flight_type'=>'oneway']),
                'status'=>200,
                'message'=>'your data has been recived',
            ],200);

        }else{
            $dataFlight_leave = Flight::with(['airlines','departureAirport','arrivalAirport'])
            ->where('id',$data['departure_flight_id'])->first();
            $dataFlight_return = Flight::with(['airlines','departureAirport','arrivalAirport'])
            ->where('id',$data['return_flight_id'])->first();
            // Combine departure and return flight data into a single array
            $combinedData = [
                'departure_flight' => $dataFlight_leave,
                'return_flight' => $dataFlight_return,
            ];
            // Convert the combined data to JSON for AJAX response
            $jsonData = json_encode($combinedData);

            return response()->json(
            [
                         //this code here to send the data to booking controller passing throught ajax
                        'redirect' => route('flightbooking', ['data' => json_encode($jsonData),'flight_type'=>'return']),
                        'status'=>200,
                        'message'=>'your data has been recived',
                ],200);
        }
    }

    // flight Booking
    public function flightbooking(Request $request)
    {
        //this code here to recive the data to booking from controller passing throught ajax
        $alldata = json_decode($request->query('data'), true);
        $dataFlight = json_decode($request->query('data'), true);
        $flight_type = $request->query('flight_type');


        // get the data of flight and hotels to check that if needed
        $countsByCountry = DB::table('flights')
        ->select('flights.flight_arrive_country',
                 DB::raw('GROUP_CONCAT(DISTINCT hotels.id) as hotel_ids'),
                 DB::raw('GROUP_CONCAT(DISTINCT flights.id) as flight_ids'),
                 DB::raw('COUNT(DISTINCT hotels.id) as hotel_count'),
                 DB::raw('COUNT(DISTINCT flights.id) as flight_count')
        )
        ->leftJoin('hotels', function($join) {
            $join->on('flights.flight_arrive_country', '=', DB::raw('(SELECT country FROM countries WHERE id = hotels.loca_country)'))->where('hotels.hotel_status', 1);
        })
        ->groupBy('flights.flight_arrive_country')

        ->get();

            // Initialize an array to hold all data
            $countryData = [];

            // Loop through the results and organize data by country
            foreach ($countsByCountry as $countryInfo) {
                $country = $countryInfo->flight_arrive_country;
                $hotelIds = explode(',', $countryInfo->hotel_ids);
                $flightIds = explode(',', $countryInfo->flight_ids);

                // Remove empty strings and convert IDs to integers
                $hotelIds = array_filter(array_map('intval', $hotelIds));
                $flightIds = array_filter(array_map('intval', $flightIds));

                // Store data for this country
                $countryData[$country] = [
                    'hotels' => $hotelIds,
                    'flights' => $flightIds,
                    'hotel_count' => $countryInfo->hotel_count,
                    'flight_count' => $countryInfo->flight_count,
                ];
                    if(in_array($alldata['id'],$countryData[$country]['flights'])){
                        $hotels = Hotel::with('Rooms')->whereIn('id',$countryData[$country]['hotels'])->get();
                    }
                }

        if($flight_type == 'oneway'){
            return view('Front_End.pages.flights.flights-booking',compact('dataFlight','flight_type','hotels'));
        }else{
            $dataFlight = json_decode($alldata, true);
            return view(
                'Front_End.pages.flights.return_flight_booking.flight_with_return_flight',
            compact('dataFlight','flight_type','hotels')
        );

        }
    }

    // payment functions
    public function paymentSubmit(Request $request)
    {

        $data = $request->all();

        // add the payment and validate the data
        $plan_type_price = ($data['plan'] === 'paid') ? 50 : 0;

        if(empty($data['baggage']) || $data['baggage'] == null){
            $baggage_price = 0;
        }else{
            foreach($data['baggage'] as $baggage){
                if(count($data['baggage']) > 1){
                    $baggage_price = 90;
                }elseif($baggage == 'cabinbag' ){
                    $baggage_price = 40;
                }elseif($baggage == 'checkedbag'){
                    $baggage_price = 50;
                }else{
                    $baggage_price = 0;
                }
            }
        }
        if(empty($data['seat'])){
            session()->flash('error','please select your seat');
            return back();
        }
        //check if the flight is avalibal
        $flight_data = Flight::find($data['flight_id']);

        // check the prices and total price if matches
        $payAmount = $data['flight_base_price'] + $baggage_price + $plan_type_price;


            if(empty($data['totalpay']) || $data['totalpay'] == null){
                $totalPrice = $data['flight_base_price'];
            }else{
                $totalPrice = $data['totalpay'];
            }

            if(!empty($data['hotel_section'])){
                $hotel_id = $data['hotel_id'];
                $room_id = $data['room_id'];
                $hotel_plan_price = $data['hotel_plan_price'];
                $hotel = Hotel::with('Rooms')->where('id',$hotel_id)->first();
                $hotelRoom = Hotelroom::where('hotel_id',$hotel_id)->where('id',$room_id)->first();

                $hoteldata= [
                    'hotel_name' =>$hotel->hotel_name,
                    'loca_country' => MyFunctions::getCountryName($hotel->loca_country,'country'),
                    'loca_city' =>  MyFunctions::getCityName($hotel->loca_city,'city'),
                    'num_of_rooms' =>$hotelRoom->num_of_rooms,
                    'room_beds' =>$hotelRoom->room_beds,
                    'room_lvl' =>$hotelRoom->room_lvl,
                    'room_type' =>$hotelRoom->room_type,
                ];
            }else{
                $hotel_id = null;
                $room_id = null;
                $hotel_plan_price = 0;
                $hoteldata =[];
            }
            // validate the Card Visa Fields.
            if($data['termsCheckbox'] == 'on'){
                $cardChecker = Cardsinfo::first();
                if(
                    $cardChecker->Cardnumber == $data['Cardnumber'] &&
                    $cardChecker->Expirymonth == $data['Expirymonth'] &&
                    $cardChecker->Expiryyear == $data['Expiryyear'] &&
                    $cardChecker->ccvnumber == $data['ccvnumber']
                ){
                    // if correct then add this process to order table and take the price from the card
                    if($data['flight_type_seat'] == 'return'){
                        $orderRef = 'FLY-'.rand(1,1000000);
                        $insertOrder = new Order();
                        $insertOrder->order_ref =  $orderRef;
                        $insertOrder->user_id = auth()->user()->id;
                        $insertOrder->flight_id = $data['flight_id'][0];
                        $insertOrder->hotel_id = $hotel_id;
                        $insertOrder->payment_type = 'visa';
                        $insertOrder->user_fname = $data['user_fname'];
                        $insertOrder->user_lname = $data['user_lname'];
                        $insertOrder->user_email = $data['user_email'];
                        $insertOrder->user_phone = $data['user_phone'];
                       // Concatenate additional information
                        $moreInfo = [
                            'flight_type' =>$data['flight_type_seat'],
                            'leave_flight_id' =>$data['flight_id'][0],
                            'return_flight_id' =>$data['flight_id'][1],
                            'plan' => $data['plan'],
                            'base_price' => $data['flight_base_price'],
                            'total_price' => $totalPrice,
                            'leave_seat' => $data['leave_seat'],
                            'return_seat' => $data['return_seat'],
                            'baggage' => $baggage_price,
                            'hotel_data' =>$hoteldata,
                            'hotel_plan_price' => $hotel_plan_price
                        ];
                        // You can use serialize or any other method based on your preference
                        $insertOrder->moreinfo = json_encode($moreInfo);
                        $insertOrder->amount =  $totalPrice;
                        $insertOrder->status = '1';
                        $insertOrder->booking_status = 'paid';
                        // Save the order

                        $dataEmail = [
                            'email_type' => 'return_flight',
                            'username' => $data['user_fname'].' '.$data['user_lname'],
                            'order_ref'=> $orderRef,
                            'flightinfo'=> Flight::find($data['flight_id']),
                            'payment_type'=> 'visa',
                            'user_email'=> $data['user_email'],
                            'user_phone'=> $data['user_phone'],
                            'amount'=>  $totalPrice,
                            'otherInfo' =>$moreInfo,
                        ];

                        $insertOrder->save();
                        if($insertOrder->save()){
                        Mail::to($data['user_email'])->send( new Userbookingemail($dataEmail));
                        $cardAmount = $cardChecker->amount - $totalPrice;
                        Cardsinfo::where('id',1)->update(
                            [
                                'amount' => $cardAmount
                            ]);
                        }
                        session()->flash('success',
                       'Thank you for your order , you will revice an email with the confirmation');
                        return redirect()->route('homepage');
                    }else{
                        $orderRef = 'FLY-'.rand(1,1000000);
                        $insertOrder = new Order();
                        $insertOrder->order_ref = $orderRef;
                        $insertOrder->user_id = auth()->user()->id;
                        $insertOrder->flight_id = $data['flight_id'];
                        $insertOrder->hotel_id = $hotel_id;
                        $insertOrder->payment_type = 'visa';
                        $insertOrder->user_fname = $data['user_fname'];
                        $insertOrder->user_lname = $data['user_lname'];
                        $insertOrder->user_email = $data['user_email'];
                        $insertOrder->user_phone = $data['user_phone'];
                       // Concatenate additional information
                        $moreInfo = [
                            'plan' => $data['plan'],
                            'base_price' => $data['flight_base_price'],
                            'total_price' =>  $totalPrice,
                            'seat' => $data['seat'],
                            'baggage' => $baggage_price,
                            'hotel_data' =>$hoteldata,
                            'hotel_plan_price' => $hotel_plan_price
                        ];
                        // You can use serialize or any other method based on your preference
                        $insertOrder->moreinfo = json_encode($moreInfo);
                        $insertOrder->amount =  $totalPrice;
                        $insertOrder->status = '1';
                        $insertOrder->booking_status = 'paid';
                        // Save the order

                        $dataEmail = [
                            'email_type' => 'oneway_flight',
                            'username' => $data['user_fname'].' '.$data['user_lname'],
                            'order_ref'=> $orderRef,
                            'payment_type'=> 'visa',
                            'flightinfo'=> Flight::find($data['flight_id']),
                            'user_email'=> $data['user_email'],
                            'user_phone'=> $data['user_phone'],
                            'amount'=>  $totalPrice,
                            'otherInfo' =>$moreInfo,
                        ];

                        $insertOrder->save();
                        if($insertOrder->save()){
                        // send email to user
                        Mail::to($data['user_email'])->send( new Userbookingemail($dataEmail));
                        $cardAmount = $cardChecker->amount -  $totalPrice;
                        Cardsinfo::where('id',1)->update(
                            [
                                'amount' => $cardAmount
                            ]);
                        }
                       session()->flash('success',
                       'Thank you for your order , you will revice an email with the confirmation');
                        return redirect()->route('homepage');
                    }
                 }else{
                    session()->flash('error','your card is not correct , please try again');
                    return back();
                 }
            }

        // check the card visa and validate it
    }
    // update price of titcked
    public function changeFlightPrice(Request $request)
    {
        $data = $request->all();

        $dataFlight = json_decode($data['data'],true);
        if(!empty($dataFlight['plan'])){
            // Adjust the price based on the selected plan
            $price = ($dataFlight['plan'] === 'paid') ? 50 : 0;

            // Check if "cabinbag" is selected
            if (in_array('cabinbag', $request->input('baggage', []))) {
                $price += 40;
            }

            // Check if "checkedbag" is selected
            if (in_array('checkedbag', $request->input('baggage', []))) {
                $price += 50;
            }
            return response()->json(['status' => 'success', 'price' => $price]);
        }else{
            $covertArrayDataFlight = json_decode($dataFlight,true);
            $plan = $request->query('plan');
            $selectedPlan1 = isset($dataFlight['plan']) ? $dataFlight['plan'] : 'free';
            if( !empty($plan) || $plan != null ){
                $selectedPlan  = $plan;
            }else{
                $selectedPlan = $selectedPlan1;
            }
            // Adjust the price based on the selected plan
            $price = ($selectedPlan === 'paid') ? 50 : 0;

            // Check if "cabinbag" is selected
            if (in_array('cabinbag', $request->input('baggage', []))) {
                $price += 40;
            }

            // Check if "checkedbag" is selected
            if (in_array('checkedbag', $request->input('baggage', []))) {
                $price += 50;
            }
            return response()->json(['status' => 'success', 'price' => $price,
            "departure_flight_price"=> $covertArrayDataFlight['departure_flight']['flight_price'],
            "departure_flight_offer_price"=> $covertArrayDataFlight['departure_flight']['offer_price'],
            "return_flight_offer_price"=> $covertArrayDataFlight['departure_flight']['offer_price'],
            "return_flight_price" => $covertArrayDataFlight['return_flight']['flight_price']], 200);
        }
    }

    public function thankyou($info)
    {
        dd($info);
        return view('Front_End.pages.booking.confirmation');
    }
    // change the seate and update the number of them
    public function selectseats(Request $request)
    {
        // check if the flight is avalibal

       if($request->input('flightType') == 'oneway'){

           $flightid = $request->input('flight_id');
           $checkflights = Flight::find($flightid);
           if($checkflights){
               //get all data from order table to see avalibal seats
               $seats = [];
               $orderSeats = Order::where('flight_id',$checkflights->id)->get();
               foreach($orderSeats as $seat){
                $seatdata = json_decode($seat['moreinfo']);
                $seats[] = $seatdata->seat;
               }
              return response()->json(['seats' => $seats , 'status'=>'success']);
           }
       }

       if($request->input('flightType') == 'return'){
        $flightIds = $request->input('flightIds');

    if (count($flightIds) == 2) {
        $departure_flight = Flight::find($flightIds[0]);
        $return_flight = Flight::find($flightIds[1]);
        $seats_departure_flight = $this->getAvailableSeats($departure_flight->id);
        $seats_return_flight = $this->getAvailableSeats($return_flight->id);

        return response()->json([
            'departure_flight' => $seats_departure_flight,
            'return_flight' => $seats_return_flight,
            'status' => 'success'
        ]);
        } else {
            return response()->json(['error' => 'Invalid flight IDs'], 400);
        }
       }
    }
    // related to above
    private function getAvailableSeats($flight) {
        $seats = [];

        if ($flight) {
            $orderSeats = Order::where('flight_id', $flight)->get();

            foreach ($orderSeats as $seat) {
                $seatdata = json_decode($seat['moreinfo']);
                if($seatdata->flight_type == 'return'){
                    $seats[] = $seatdata->leave_seat;
                    $seats[] = $seatdata->return_seat;

                }else{
                    $seats[] = $seatdata->seat;
                }
            }
        }
        return $seats;
    }
}
