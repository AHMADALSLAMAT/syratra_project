@php
$flightinfodata = json_decode($order->moreinfo,true);

@endphp

<!-- this to show both flights if it has return type -->
@if (!empty($flightinfodata['flight_type']) && $flightinfodata['flight_type'] == 'return')
    @php
    $departure_flight = \App\Models\Flight::with(['airlines','departureAirport','arrivalAirport'])
    ->where('id', $flightinfodata['leave_flight_id'])
    ->where('flight_status', 1)->first();
    $return_flight = \App\Models\Flight::with(['airlines','departureAirport','arrivalAirport'])
    ->where('id', $flightinfodata['return_flight_id'])
    ->where('flight_status', 1)->first();
    @endphp
    <div class="flights">
        <div class="modal-body">
            <!-- Header -->
            <header class="card-header bg-light py-4 px-4">
                <div class="col-md-4 mb-4 mb-md-3">
                    <div class="d-block d-lg-flex flex-horizontal-center">
                        <img class="img-fluid mr-3 mb-3 mb-lg-0"
                            src="{{ asset($departure_flight['airlines']['airline_logo']) }}" alt="Image-Description"
                            width="100">
                        <div class="font-size-14">{{$departure_flight['flight_name']}} |
                            {{ $departure_flight['flight_sku'] }}</div>
                    </div>
                </div>
                <div class="row align-items-center text-center">
                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $departure_flight['flight_leave_hours'] }}</h6>
                                <div class="font-size-14 text-gray-5">
                                    {{ $departure_flight['flight_leave_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $departure_flight['departureAirport']['name'] }}
                                    <small
                                        style="font-size: 10px">({{ $departure_flight['departureAirport']['countryName'] }})
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center flex-column">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                {{App\Helpers\Flight::calculateHoursDifference(
                                    $departure_flight['flight_leave_date'],$departure_flight['flight_leave_hours'],
                                    $departure_flight['flight_arrive_date'],$departure_flight['flight_arrive_hours']) }}
                            </h6>
                            <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                            <div class="font-size-14 text-gray-1">
                                @if($return_flight['flight_stops'] != 0)
                                {{ count($return_flight['flight_stops_country']) }} Stops
                                @else
                                No Stops
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $departure_flight['flight_arrive_hours'] }}</h6>
                                <div class="font-size-14 text-gray-5">
                                    {{ $departure_flight['flight_arrive_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $departure_flight['arrivalAirport']['name'] }}
                                    <small
                                        style="font-size: 10px">({{ $departure_flight['arrivalAirport']['countryName'] }})
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center text-center">
                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $return_flight['flight_leave_hours'] }}</h6>
                                <div class="font-size-14 text-gray-5">
                                    {{ $return_flight['flight_leave_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $return_flight['departureAirport']['name'] }}
                                    <small
                                        style="font-size: 10px">({{ $return_flight['departureAirport']['countryName'] }})
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center flex-column">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                {{App\Helpers\Flight::calculateHoursDifference(
                                $return_flight['flight_leave_date'],$return_flight['flight_leave_hours'],
                                $return_flight['flight_arrive_date'],$return_flight['flight_arrive_hours']) }}
                            </h6>
                            <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                            <div class="font-size-14 text-gray-1">
                                @if($return_flight['flight_stops'] != 0)
                                {{ count($return_flight['flight_stops_country']) }} Stops
                                @else
                                No Stops
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $return_flight['flight_arrive_hours'] }}</h6>
                                <div class="font-size-14 text-gray-5">
                                    {{ $return_flight['flight_arrive_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $return_flight['arrivalAirport']['name'] }}
                                    <small style="font-size: 10px">({{ $return_flight['arrivalAirport']['countryName'] }})
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header -->
            <!-- Body -->
            <div class="card-body py-4 p-md-5">
                <div class="row">
                    <div class="col">
                        <ul
                            class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Baggage</div>
                                <span class="text-gray-1">Adult</span>
                            </li>
                            @if ($flightinfodata['baggage'] == 90)
                                <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                    <div class="font-weight-bold text-dark">
                                        Check-in</div>
                                    <span class="text-gray-1">15
                                        Kgs</span>
                                </li>
                                <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                    <div class="font-weight-bold text-dark">
                                        Cabin</div>
                                    <span class="text-gray-1">7
                                        Kgs</span>
                                </li>
                                @elseif($flightinfodata['baggage'] == 50)
                                <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                    <div class="font-weight-bold text-dark">
                                        Check-in</div>
                                    <span class="text-gray-1">15
                                        Kgs</span>
                                </li>
                                @elseif($flightinfodata['baggage'] == 40)
                                <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                    <div class="font-weight-bold text-dark">
                                        Cabin</div>
                                    <span class="text-gray-1">7
                                        Kgs</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-auto">
                        <div class="min-width-250">
                            <h5 class="font-size-17 font-weight-bold text-dark">
                                Fare breakup</h5>
                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Base
                                        </span>
                                    <span class="text-secondary">
                                        {{
                                            $departure_flight['base_price'] +
                                            $return_flight['flight_price'] }} $
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">baggage</span>
                                    <span class="text-secondary">
                                        {{$flightinfodata['baggage']}} $
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Backages</span>
                                    <span class="text-secondary">€0,00</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                    <span class="font-weight-bold">Pay
                                        Amount</span>
                                    <span class="">
                                        {{ $order->total_price }} $
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Body -->
        </div>
    </div>
<!-- if has single flight -->
@else
    @php
    $departureflight = \App\Models\Flight::with(['airlines','departureAirport','arrivalAirport'])
    ->where('id', $order->flight_id)
    ->where('flight_status', 1)->first();
    @endphp
    @if($departureflight)

    <div class="flight">
        <div class="modal-body">
            <!-- Header -->
            <header class="card-header bg-light py-4 px-4">
                <div class="col-md-4 mb-4 mb-md-3">
                    <div class="d-block d-lg-flex flex-horizontal-center">
                        <img class="img-fluid mr-3 mb-3 mb-lg-0"
                            src="{{ asset($departureflight['airlines']['airline_logo']) }}"
                            alt="Image-Description"
                            width="100">
                        <div class="font-size-14">
                            {{$departureflight['flight_name']}} | {{ $departureflight['flight_sku'] }}
                        </div>
                    </div>
                </div>
                <div class="row align-items-center text-center">
                    <div class="col-md-12 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    18:30</h6>
                                <div class="font-size-14 text-gray-5">
                                    Sat, 21 Sep 19</div>
                                <span class="font-size-14 text-gray-1">New
                                    Delhi, India</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center flex-column">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                02 hrs 45 mins</h6>
                            <div class="width-60 border-top border-primary border-width-2 my-1">
                            </div>
                            <div class="font-size-14 text-gray-1">
                                Non Stop</div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4 mb-md-3">
                        <div class="mx-2 mx-xl-3 flex-content-center align-items-center d-block d-lg-flex">
                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                            </div>
                            <div class="text-lg-left">
                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    21.15</h6>
                                <div class="font-size-14 text-gray-5">
                                    Sun, 22 Sep 19</div>
                                <span class="font-size-14 text-gray-1">Bengaluru,
                                    India</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header -->
            <!-- Body -->
            <div class="card-body py-4 p-md-5">
                <div class="row">
                    <div class="col">
                        <ul
                            class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Baggage</div>
                                <span class="text-gray-1">Adult</span>
                            </li>
                            @if ($flightinfodata['baggage'] == 90)
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Check-in</div>
                                <span class="text-gray-1">15
                                    Kgs</span>
                            </li>
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Cabin</div>
                                <span class="text-gray-1">7
                                    Kgs</span>
                            </li>
                            @elseif($flightinfodata['baggage'] == 50)
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Check-in</div>
                                <span class="text-gray-1">15
                                    Kgs</span>
                            </li>
                            @elseif($flightinfodata['baggage'] == 40)
                            <li class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                <div class="font-weight-bold text-dark">
                                    Cabin</div>
                                <span class="text-gray-1">7
                                    Kgs</span>
                            </li>
                        @endif
                        </ul>
                    </div>
                    <div class="col-auto">
                        <div class="min-width-250">
                            <h5 class="font-size-17 font-weight-bold text-dark">
                                Fare breakup</h5>
                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Base
                                        Fare</span>
                                    <span class="text-secondary">€580,00</span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Surcharges</span>
                                    <span class="text-secondary">€0,00</span>
                                </li>

                                <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                    <span class="font-weight-bold">Pay
                                        Amount</span>
                                    <span class="">€580,00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Body -->
        </div>
    </div>

    @else
    <div class="alert alert-danger" role="alert">
        Flight details not found.
    </div>
    @endif
@endif
