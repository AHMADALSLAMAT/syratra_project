<?php

namespace App\Http\Controllers\Front_End;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\Cardsinfo;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use App\Mail\Userbookingemail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HotelController extends Controller
{
    public function view_hotel(){
        // hotel filter in hotel page get the data from the link top
        $hotels = Hotel::query();
        if (!empty($_GET['hotel_name'])) {
            $slugs = explode(',', $_GET['hotel_name']);
            $hotels = $hotels->whereIn('slug', $slugs);
        }
        if (!empty($_GET['hotel_type'])) {
            $hotel_type = explode(',', $_GET['hotel_type']);
            $hotels = $hotels->whereIn('hotel_type', $hotel_type);
        }
        if (!empty($_GET['hotel_location'])) {
            $hotel_location = explode(',', $_GET['hotel_location']);
            $hotels = $hotels->whereIn('loca_country', $hotel_location);
        }

        $hotels = $hotels->with('Rooms')->where('hotel_status',1)->paginate(20);

        // FILTER DATA GET ALL OF THEM.
        $hotels_names = Hotel::where('hotel_status' , 1)->get();
        // get all the internal hotels and external hotels to show in filter
        $hotelstype = Hotel::select('hotel_type', DB::raw('count(hotel_type) as total'))
            ->groupBy('hotel_type')
            ->get();

        // get all the locations hotels  to show in filter
        $hotelslocation= Hotel::select('loca_country', DB::raw('count(loca_country) as total'))
        ->groupBy('loca_country')
        ->get();

        return view('Front_End.pages.hotels.hotel-list',compact(
            'hotels',
            'hotels_names',
            'hotelstype',
            'hotelslocation'));
    }

    // Single Page For Each Hotel

    public function single_hotel($slug){
        // find the hotel by slug

        $hotel_count = Hotel::where('hotel_status',1)->where('slug',$slug)->count();
        if($hotel_count > 0 ){
            $hotel = Hotel::with('Rooms')->where('hotel_status',1)->where('slug',$slug)->first();
             // relaed hotels based on hotel type
            $related_hotel = Hotel:: where('hotel_type',$hotel->hotel_type)->where('id','!=',$hotel->id )->take(10)->get();

            return view('Front_End.pages.hotels.hotel-single',compact('hotel','related_hotel'));
        }else{
            return back();
        }

    }
    // Filter For Hotels
    public function hotel_filter(Request $request){
       $data = $request->all();
        $catUrl = '';
        if(!empty($data['hotel_name'])){
            foreach($data['hotel_name'] as $hotel){
                if(empty($catUrl)){
                    $catUrl.='&hotel_name='.$hotel;
                }else{
                    $catUrl.=','.$hotel;
                }
            }
        }
        $hotel_type = '';
        if(!empty($data['hotel_type'])){
            foreach($data['hotel_type'] as $type){
                if(empty($hotel_type)){
                    $hotel_type.='&hotel_type='.$type;
                }else{
                    $hotel_type.=','.$type;
                }
            }
        }
        $hotel_location = '';
        if(!empty($data['hotel_location'])){
            foreach($data['hotel_location'] as $lcoation){
                if(empty($hotel_location)){
                    $hotel_location.='&hotel_location='.$lcoation;
                }else{
                    $hotel_location.=','.$lcoation;
                }
            }
        }
        return redirect()->route('view_hotel', $catUrl.$hotel_type.$hotel_location);
    }

    // Hotel Booking

    public function hotel_booking($slug){

        //get the info of the room to book
        $room_info = HotelRoom::with('Hotel')->where('id',$slug)->first();
        return view('Front_End.pages.hotels.hotel-booking',compact('room_info'));

    }

    public function hotelpayment(Request $request)
    {

        $data = $request->all();
        $totalPrice = $data['totalPrice'];
        $room_id = $data['room_id'];
        $hotel_id = $data['hotel_id'];
        $number_of_nights = $data['number_of_nights'];
        $stay_from = $data['stay_from'];
        $leave_at = $data['leave_at'];

        // validation

        $check_hotel_id = Hotel::where('id',$hotel_id)->count();

        if($check_hotel_id > 0 ){
            // check if the room is valid in hotel
            $check_room_id = HotelRoom::where('id',$room_id)->where('hotel_id',$hotel_id)->count();

            if($check_room_id > 0){
               $room_data = HotelRoom::where('id',$room_id)->where('hotel_id',$hotel_id)->first();
               $hotel_data = Hotel::where('id',$hotel_id)->first();

               // validate the price
                $totalPrice = $room_data->room_price * $number_of_nights;
                // check the price
                 if(
                 !empty($data['termsCheckbox']) || $data['termsCheckbox'] != null &&
                 !empty($data['Cardnumber']) || $data['Cardnumber'] != null &&
                 !empty($data['Expirymonth']) || $data['Expirymonth'] != null &&
                 !empty($data['Expiryyear']) || $data['Expiryyear'] != null &&
                 !empty($data['ccvnumber']) || $data['ccvnumber'] != null ){

                    $check_card = Cardsinfo::first();
                    if(
                        $check_card->Cardnumber == $data['Cardnumber'] &&
                        $check_card->Expirymonth == $data['Expirymonth'] &&
                        $check_card->Expiryyear == $data['Expiryyear'] &&
                        $check_card->ccvnumber == $data['ccvnumber']
                    ){
                        $orderRef = 'FLY-'.rand(1,1000000);
                        $insertOrder = new Order();
                        $insertOrder->order_ref = $orderRef ;
                        $insertOrder->user_id = auth()->user()->id;
                        $insertOrder->hotel_id = $data['hotel_id'];
                        $insertOrder->payment_type = 'visa';
                        $insertOrder->user_fname = $data['user_fname'];
                        $insertOrder->user_lname = $data['user_lname'];
                        $insertOrder->user_email = $data['user_email'];
                        $insertOrder->user_phone = $data['user_phone'];
                        // Concatenate additional information
                            $moreInfo = [
                                'number_of_nights' => $data['number_of_nights'],
                                'stay_from' => $data['stay_from'],
                                'total_price' => $totalPrice,
                                'leave_at' => $data['leave_at'],
                                'Room' => $room_data,
                                'hotel' => $hotel_data,
                            ];
                            // You can use serialize or any other method based on your preference
                            $insertOrder->moreinfo = json_encode($moreInfo);
                            $insertOrder->amount =  $totalPrice;
                            $insertOrder->status = '1';
                            $insertOrder->booking_status = 'Paid';
                            // Save the order

                              // Save the order
                              $dataEmail = [
                                'email_type' => 'hotels',
                                'username' => $data['user_fname'].' '.$data['user_lname'],
                                'order_ref'=> $orderRef,
                                'payment_type'=> 'visa',
                                'Room' => $room_data,
                                'hotel' => $hotel_data,
                                'user_email'=> $data['user_email'],
                                'user_phone'=> $data['user_phone'],
                                'amount'=>  $totalPrice,
                                'number_of_nights' => $data['number_of_nights'],
                                'stay_from' => $data['stay_from'],
                                'total_price' => $totalPrice,
                                'leave_at' => $data['leave_at'],
                            ];

                            $insertOrder->save();
                            if($insertOrder->save()){
                                Mail::to($data['user_email'])->send( new Userbookingemail($dataEmail));

                                $cardAmount = $check_card->amount -  $totalPrice;
                                Cardsinfo::where('id',1)->update(
                                    [
                                        'amount' => $cardAmount
                                    ]);
                            }
                            session()->flash('success','Thank you for your order ,
                            you will revice an email with the confirmation');
                            return redirect()->route('homepage');
                    }else{
                        $insertOrder = new Order();
                        $insertOrder->order_ref = 'FLY-'.rand(1,1000000);
                        $insertOrder->user_id = auth()->user()->id;
                        $insertOrder->hotel_id = $data['hotel_id'];
                        $insertOrder->payment_type = 'HOD';
                        $insertOrder->user_fname = $data['user_fname'];
                        $insertOrder->user_lname = $data['user_lname'];
                        $insertOrder->user_email = $data['user_email'];
                        $insertOrder->user_phone = $data['user_phone'];
                            // Concatenate additional information
                            $moreInfo = [
                                'number_of_nights' => $data['number_of_nights'],
                                'stay_from' => $data['stay_from'],
                                'total_price' => $totalPrice,
                                'leave_at' => $data['leave_at'],
                                'Room' => $room_data,
                                'hotel' => $hotel_data,
                            ];
                            // You can use serialize or any other method based on your preference
                            $insertOrder->moreinfo = json_encode($moreInfo);
                            $insertOrder->amount =  $totalPrice;
                            $insertOrder->status = '0';
                            $insertOrder->booking_status = 'pending';
                            // Save the order
                            $insertOrder->save();
                            if($insertOrder->save()){
                                $cardAmount = $check_card->amount -  $totalPrice;
                                Cardsinfo::where('id',1)->update(
                                    [
                                        'amount' => $cardAmount
                                    ]);
                            }
                            session()->flash('success','Thank you for your order ,
                            you will revice an email with the confirmation');
                            return redirect()->route('homepage');
                    }
                }else{
                    session()->flash('error','you are missing one of your
                    cards info check all of them please');
                    return back();
                }
            } else {
            session()->flash('error','the Room is not found');
            return back();
            }
        }else{
            session()->flash('error','the hotel is not found');
            return back();
        }
    }
}
