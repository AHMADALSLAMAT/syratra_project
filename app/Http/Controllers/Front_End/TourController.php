<?php

namespace App\Http\Controllers\Front_End;

use App\Models\Order;
use App\Helpers\Filter;
use App\Models\Package;
use App\Models\Cardsinfo;
use Illuminate\Http\Request;
use App\Mail\Userbookingemail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller {
    public function view_tour() {
        // hotel filter in hotel page get the data from the link top
        $packages = Package::query();
        if ( !empty( $_GET[ 'package_days' ] ) ) {
            $days = explode( ',', $_GET[ 'package_days' ] );
            $packages = $packages->whereIn( 'days', $days );

        }
        if ( !empty( $_GET[ 'package_type' ] ) ) {
            $package_type = explode( ',', $_GET[ 'package_type' ] );
            $packages = $packages->whereIn( 'package_type', $package_type );
        }

        if ( !empty( $_GET[ 'package_location' ] ) ) {
            $package_location = explode( ',', $_GET[ 'package_location' ] );
            $packages = $packages->whereIn( 'loca_country', $package_location );
        }

        // price filter
        if ( !empty( $_GET[ 'price' ] ) ) {
            $price = explode( '-', $_GET[ 'price' ] );
            $price[ 0 ] = floor( $price[ 0 ] );
            $price[ 1 ] = ceil( $price[ 1 ] );
            $packages = $packages->whereBetween( 'price', $price );
        }

        $packages = $packages->where( 'status', 1 )->paginate( 20 );

        // FILTER DATA GET ALL OF THEM.
        // get all the internal hotels and external hotels to show in filter
        $package_days = Package::select( 'days', DB::raw( 'count(days) as total' ) )
        ->groupBy( 'days' )
        ->get();

        $package_type = Package::select( 'package_type', DB::raw( 'count(package_type) as total' ) )
        ->groupBy( 'package_type' )
        ->get();
        // get all the locations hotels  to show in filter
        $packagelocation = Package::select( 'loca_country', DB::raw( 'count(loca_country) as total' ) )
        ->groupBy( 'loca_country' )
        ->get();

        return view( 'Front_End.pages.tour.tour-list', compact(
            'packages',
            'package_type',
            'package_days',
            'packagelocation' ) );
        }

        // Single Page For Each Package

        public function single_tour( $slug ) {
            // find the Package by slug
            $package_count = Package::where( 'status', 1 )->where( 'slug', $slug )->count();
            if ( $package_count > 0 ) {
                $package = Package::where( 'status', 1 )->where( 'slug', $slug )->first();
                // relaed packages based on package type
                $related_package = Package::where( 'package_type', $package->package_type )->where( 'id', '!=', $package->id )->take(10)->get();
                return view( 'Front_End.pages.tour.tour-single', compact( 'package', 'related_package' ) );
            } else {
                return back();
            }

        }

        public function package_filter( Request $request ) {
            $data = $request->all();

            // Days filter
            $catUrl = '';
            if ( !empty( $data[ 'package_days' ] ) ) {
                foreach ( $data[ 'package_days' ] as $hotel ) {
                    if ( empty( $catUrl ) ) {
                        $catUrl .= '&package_days='.$hotel;
                    } else {
                        $catUrl .= ','.$hotel;
                    }
                }
            }

            // Type filter
            $package_type = '';
            if ( !empty( $data[ 'package_type' ] ) ) {
                foreach ( $data[ 'package_type' ] as $type ) {
                    if ( empty( $package_type ) ) {
                        $package_type .= '&package_type='.$type;
                    } else {
                        $package_type .= ','.$type;
                    }
                }
            }

            // Location filter
            $package_location = '';
            if ( !empty( $data[ 'package_location' ] ) ) {
                foreach ( $data[ 'package_location' ] as $lcoation ) {
                    if ( empty( $package_location ) ) {
                        $package_location .= '&package_location='.$lcoation;
                    } else {
                        $package_location .= ','.$lcoation;
                    }
                }
            }

            // price filter
            if ( !empty( $data[ 'min_price' ] ) || !empty( $data[ 'max_price' ] ) ) {
                if ( $data[ 'min_price' ] < Filter::minPrice() ||
                $data[ 'max_price' ] > Filter::maxPrice() ||
                $data[ 'min_price' ] > $data[ 'max_price' ] ) {
                    return back()->with(
                        'error',
                        'The Price Rang is Not Correct, Search between '. Filter::minPrice() .' And '. Filter::maxPrice() );
                    }
                    if ( $data[ 'min_price' ] == null || empty( $data[ 'min_price' ] ) ) {
                        $minPrice = Filter::minPrice();
                    } else {
                        $minPrice = $data[ 'min_price' ];
                    }
                    if ( $data[ 'max_price' ] == null || empty( $data[ 'max_price' ] ) ) {
                        $maxPrice = Filter::maxPrice();
                    } else {
                        $maxPrice = $data[ 'max_price' ];
                    }
                    //filter price
                    $price = $minPrice.'-'.$maxPrice;
                }

                $price_range_url = '';

                if ( !empty( $price ) ) {
                    $price_range_url .= '&price='.$price;
                }

                return redirect()->route( 'view_tour', $catUrl.$package_type.$package_location.$price_range_url );
            }

            // TOURS PAYMENT

            public function tours_booking( Request $request, $id ) {
                $data = $request->query();

                $Nadualt = $data[ 'adults' ];
                $Nchildren = $data[ 'children' ];
                $Ninfant = $data[ 'infant' ];
                $package_id = $data[ 'package_id' ];
                $fullPrice = $data[ 'price' ];
                $tours = Package::find( $id );

                return view( 'Front_End.pages.tour.tour-booking', compact( 'tours', 'data' ) );

            }

            // Payment methods

            public function tourspayment( Request $request )
            {
                $data = $request->all();
                //dd( $data );
                $data = $request->all();
                $totalPrice = $data[ 'totalPrice' ];
                $package_id = $data[ 'package_id' ];
                $number_of_days = $data[ 'number_of_days' ];
                $number_of_adults = $data[ 'number_of_adults' ];
                $number_of_children = $data[ 'number_of_children' ];
                $number_of_infants = $data[ 'number_of_infants' ];

                // validation

                $check_package_id = Package::where( 'id', $package_id )->count();

                if ( $check_package_id > 0 )
                {
                    $package_id = Package::where( 'id', $package_id )->first();

                    // check the price
                    if ( !empty( $data[ 'termsCheckbox' ] ) || $data[ 'termsCheckbox' ] != null &&
                    !empty( $data[ 'Cardnumber' ] ) || $data[ 'Cardnumber' ] != null &&
                    !empty( $data[ 'Expirymonth' ] ) || $data[ 'Expirymonth' ] != null &&
                    !empty( $data[ 'Expiryyear' ] ) || $data[ 'Expiryyear' ] != null &&
                    !empty( $data[ 'ccvnumber' ] ) || $data[ 'ccvnumber' ] != null )
                    {

                        $check_card = Cardsinfo::first();
                        if ( $check_card->Cardnumber == $data[ 'Cardnumber' ] &&
                        $check_card->Expirymonth == $data[ 'Expirymonth' ] &&
                        $check_card->Expiryyear == $data[ 'Expiryyear' ] &&
                        $check_card->ccvnumber == $data[ 'ccvnumber' ] )
                        {
                            $orderRef = 'FLY-'.rand( 1, 1000000 );
                            $insertOrder = new Order();

                            $insertOrder->order_ref = $orderRef;
                            $insertOrder->user_id = auth()->user()->id;
                            $insertOrder->package_id = $data[ 'package_id' ];
                            $insertOrder->payment_type = 'visa';
                            $insertOrder->user_fname = $data[ 'firstName' ];
                            $insertOrder->user_lname = $data[ 'lasstName' ];
                            $insertOrder->user_email = $data[ 'user_email' ];
                            $insertOrder->user_phone = $data[ 'user_phone' ];
                            // Concatenate additional information
                            $moreInfo = [
                                'adults' => $number_of_adults,
                                'children' => $number_of_children,
                                'totalPrice' => $totalPrice,
                                'days' => $number_of_days,
                                'infant' => $number_of_infants,
                            ];
                            // You can use serialize or any other method based on your preference
                            $insertOrder->moreinfo = json_encode( $moreInfo );
                            $insertOrder->amount =  $totalPrice;
                            $insertOrder->status = '1';
                            $insertOrder->booking_status = 'Paid';
                            // Save the order
                            $dataEmail = [
                                'email_type' => 'packages',
                                'username' => $data['firstName'].' '.$data['lasstName'],
                                'order_ref'=> $orderRef,
                                'payment_type'=> 'visa',
                                'flightinfo'=> Package::find($data['package_id']),
                                'user_email'=> $data['user_email'],
                                'user_phone'=> $data['user_phone'],
                                'amount'=>  $totalPrice,
                                'otherInfo' =>$moreInfo,
                            ];

                            $insertOrder->save();
                            if ( $insertOrder->save() ) {
                                Mail::to($data['user_email'])->send( new Userbookingemail($dataEmail));

                                $cardAmount = $check_card->amount -  $totalPrice;
                                Cardsinfo::where( 'id', 1 )->update(
                                    [
                                        'amount' => $cardAmount
                                    ] );
                                }
                                session()->flash( 'success', 'Thank you for your order ,
                            you will revice an email with the confirmation' );
                                return redirect()->route( 'homepage' );
                        } else
                            {
                                $insertOrder = new Order();
                                $insertOrder->order_ref = 'FLY-'.rand( 1, 1000000 );
                                $insertOrder->user_id = auth()->user()->id;
                                $insertOrder->package_id = $data[ 'package_id' ];
                                $insertOrder->payment_type = 'HOD';
                                $insertOrder->user_fname = $data[ 'firstName' ];
                                $insertOrder->user_lname = $data[ 'lasstName' ];
                                $insertOrder->user_email = $data[ 'user_email' ];
                                $insertOrder->user_phone = $data[ 'user_phone' ];
                                // Concatenate additional information
                                $moreInfo = [
                                    'adults' => $number_of_adults,
                                    'children' => $number_of_children,
                                    'totalPrice' => $totalPrice,
                                    'days' => $number_of_days,
                                    'infant' => $number_of_infants,
                                ];
                                // You can use serialize or any other method based on your preference
                                $insertOrder->moreinfo = json_encode( $moreInfo );
                                $insertOrder->amount =  $totalPrice;
                                $insertOrder->status = '0';
                                $insertOrder->booking_status = 'pending';
                                // Save the order
                                $insertOrder->save();
                                if ( $insertOrder->save() ) {
                                    $cardAmount = $check_card->amount -  $totalPrice;
                                    Cardsinfo::where( 'id', 1 )->update(
                                        [
                                            'amount' => $cardAmount
                                        ] );
                                    }
                                    session()->flash( 'success', 'Thank you for your order ,
                                                you will revice an email with the confirmation' );
                                    return redirect()->route( 'homepage' );
                            }
                            #################
                    } else
                    {
                                session()->flash( 'error', 'you are missing one of your
                                            cards info check all of them please' );
                                return back();
                    }
                            #############
                } else
                {
                            session()->flash( 'error', 'the hotel is not found' );
                            return back();
                }
                            ###################
            }
    }
