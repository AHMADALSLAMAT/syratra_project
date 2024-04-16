@foreach ($resultSearch['return_flight'] as $key => $return_flight)
<div class="mb-5">
    <div class="hover-bg-gray-1 border rounded-xs py-4 px-4 px-xl-5">
        <div class="row align-items-center text-center">
            <div class="col-md mb-4 mb-md-0">
                <img class="img-fluid"
                    src="{{ asset($resultSearch['departure_flight']->airlines->airline_logo) }}"
                    alt="Image-Description" width="100px">
                    @if ( count($resultSearch['return_flight']) > 0 )
                <hr>
                <img class="img-fluid"
                        src="{{ asset($return_flight->airlines->airline_logo) }}"
                        alt="Image-Description" width="100px">

                @endif
            </div>
            <div class="col-md mb-4 mb-md-0">
                <div class="flex-content-center d-block d-lg-flex">
                    <div class="mr-lg-3 mb-1 mb-lg-0">
                        <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                    </div>
                    <div class="text-lg-left">
                        <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                            {{ $resultSearch['departure_flight']->flight_leave_hours }}
                        </h6>
                        <span
                            class="font-size-10 text-gray-1">{{ $resultSearch['departure_flight']->flight_leave_airport }}</span>
                    </div>
                </div>
                @if (count($resultSearch['return_flight']) > 0 )
                    <hr>
                    <div class="flex-content-center d-block d-lg-flex">
                        <div class="mr-lg-3 mb-1 mb-lg-0">
                            <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lg-left">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ $return_flight->flight_leave_hours }}
                            </h6>
                            <span
                                class="font-size-10 text-gray-1">{{ $return_flight->flight_leave_airport }}</span>
                        </div>
                    </div>
            @endif
            </div>
            <div class="col-md mb-4 mb-md-0">
                <div class="flex-content-center flex-column">
                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                        {{ App\Helpers\Flight::calculateHoursDifference(
                                $resultSearch['departure_flight']->flight_leave_date,$resultSearch['departure_flight']->flight_leave_hours,
                                $resultSearch['departure_flight']->flight_arrive_date,$resultSearch['departure_flight']->flight_arrive_hours) }}
                    </h6>
                    <div class="width-60 border-top border-primary border-width-2 my-1">
                    </div>
                    @if ($resultSearch['departure_flight']->flight_stops > 0 )
                    <div class="font-size-14 text-gray-1">
                        {{ count($resultSearch['departure_flight']->flight_stops_country) }}
                        Stop</div>
                    @else
                    <div class="font-size-14 text-gray-1">Non Stop</div>
                    @endif
                </div>
                @if (count($resultSearch['return_flight']) > 0 )
                <hr>
                <div class="flex-content-center flex-column">
                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                        {{ App\Helpers\Flight::calculateHoursDifference(
                                $return_flight->flight_leave_date,$return_flight->flight_leave_hours,
                                $return_flight->flight_arrive_date,$return_flight->flight_arrive_hours) }}
                    </h6>
                    <div class="width-60 border-top border-primary border-width-2 my-1">
                    </div>
                    @if ($return_flight->flight_stops > 0 )
                    <div class="font-size-14 text-gray-1">
                        {{ count($return_flight->flight_stops_country) }} Stop
                    </div>
                    @else
                    <div class="font-size-14 text-gray-1">Non Stop</div>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-md mb-4 mb-md-0">
                <div class="flex-content-center d-block d-lg-flex">
                    <div class="mr-lg-3 mb-1 mb-lg-0">
                        <i
                            class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                    </div>
                    <div class="text-lg-left">
                        <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                            {{ $resultSearch['departure_flight']->flight_arrive_hours }}
                        </h6>
                        <span class="font-size-10 text-gray-1">
                            {{ $resultSearch['departure_flight']->flight_arrive_airport }}</span>
                    </div>
                </div>
                @if (count($resultSearch['return_flight']) > 0 )
                <hr>
                <div class="flex-content-center d-block d-lg-flex">
                    <div class="mr-lg-3 mb-1 mb-lg-0">
                        <i
                            class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                    </div>
                    <div class="text-lg-left">
                        <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                            {{ $return_flight->flight_arrive_hours }}
                        </h6>
                        <span class="font-size-10 text-gray-1">
                            {{ $return_flight->flight_arrive_airport }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-2gdot8">
                <div class="border-xl-left">
                    <div class="ml-xl-5">
                        <div class="mb-2">
                            <div class="mb-2 text-lh-1dot4">

                                @if ( !empty($resultSearch['departure_flight'])
                                && count($resultSearch['return_flight']) > 0)
                                <span class="font-weight-bold font-size-22">
                                    {{ $resultSearch['departure_flight']->flight_price + $return_flight->flight_price }}
                                    $
                                </span>
                                @else
                                {{ $resultSearch['departure_flight']->flight_price }} $
                                @endif
                            </div>
                            <!-- SEND DATA TO BOOKING PAGE USING THE IDS -->
                                <a href="#" data-flight_leave="{{ $resultSearch['departure_flight']->id }}"
                                    data-return_flight="{{ $return_flight->id }}"
                                    class="btn booknowbtn btn-outline-primary border-radius-3 d-flex align-items-center justify-conten t-center min-height-50 font-weight-bold border-width-2 py-2 w-100">Book
                                    Now</a>
                        </div>
                        <!-- On Target Modal -->
                        <a class="font-size-14 text-gray-1 d-block"
                            href="#ontarget{{ $resultSearch['departure_flight']->id }}Modal"
                            data-modal-target="#ontarget{{ $resultSearch['departure_flight']->id }}Modal"
                            data-modal-effect="fadein">
                            Flight Details
                        </a>
                        <div id="ontarget{{ $resultSearch['departure_flight']->id }}Modal"
                            class="js-modal-window u-modal-window max-width-960"
                            data-modal-type="ontarget" data-open-effect="fadeIn"
                            data-close-effect="fadeOut" data-speed="500">
                            <div class="card mx-4 mx-xl-0 mb-4 mb-md-0">
                                <button type="button"
                                    class="border-0 width-50 height-50 bg-primary flex-content-center position-absolute rounded-circle mt-n4 mr-n4 top-0 right-0"
                                    aria-label="Close" onclick="Custombox.modal.close();">
                                    <i aria-hidden="true"
                                        class="flaticon-close text-white font-size-14"></i>
                                </button>
                                <!-- Header -->
                                <header class="card-header bg-light py-4 px-4">
                                    <div class="row align-items-center text-center">
                                        <div class="col-md-auto mb-4 mb-md-0">
                                            <div
                                                class="d-block d-lg-flex flex-horizontal-center">
                                                <img class="img-fluid mr-3 mb-3 mb-lg-0"
                                                    src="../../assets/img/90x90/img1.png"
                                                    alt="Image-Description">
                                                <div class="font-size-14">Spicejet SG
                                                    143 | Boeing 737-700</div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto mb-4 mb-md-0">
                                            <div
                                                class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                    <i
                                                        class="flaticon-aeroplane font-size-30 text-primary"></i>
                                                </div>
                                                <div class="text-lg-left">
                                                    <h6
                                                        class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                        18:30</h6>
                                                    <div class="font-size-14 text-gray-5">
                                                        Sat, 21 Sep 19</div>
                                                    <span class="font-size-14 text-gray-1">New
                                                        Delhi, India</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto mb-4 mb-md-0">
                                            <div
                                                class="mx-2 mx-xl-3 flex-content-center flex-column">
                                                <h6
                                                    class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                                    02 hrs 45 mins</h6>
                                                <div
                                                    class="width-60 border-top border-primary border-width-2 my-1">
                                                </div>
                                                <div class="font-size-14 text-gray-1">
                                                    Non Stop</div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto mb-4 mb-md-0">
                                            <div
                                                class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                    <i
                                                        class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                                </div>
                                                <div class="text-lg-left">
                                                    <h6
                                                        class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                        21.15</h6>
                                                    <div class="font-size-14 text-gray-5">
                                                        Sun, 22 Sep 19</div>
                                                    <span
                                                        class="font-size-14 text-gray-1">Bengaluru,
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
                                                <li
                                                    class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                    <div class="font-weight-bold text-dark">
                                                        Baggage</div>
                                                    <span class="text-gray-1">Adult</span>
                                                </li>
                                                <li
                                                    class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                    <div class="font-weight-bold text-dark">
                                                        Check-in</div>
                                                    <span class="text-gray-1">15
                                                        Kgs</span>
                                                </li>
                                                <li
                                                    class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                                                    <div class="font-weight-bold text-dark">
                                                        Cabin</div>
                                                    <span class="text-gray-1">7
                                                        Kgs</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <div class="min-width-250">
                                                <h5
                                                    class="font-size-17 font-weight-bold text-dark">
                                                    Fare breakup</h5>
                                                <ul
                                                    class="list-unstyled font-size-1 mb-0 font-size-16">
                                                    <li
                                                        class="d-flex justify-content-between py-2">
                                                        <span class="font-weight-medium">Base
                                                            Fare</span>
                                                        <span
                                                            class="text-secondary">€580,00</span>
                                                    </li>

                                                    <li
                                                        class="d-flex justify-content-between py-2">
                                                        <span
                                                            class="font-weight-medium">Surcharges</span>
                                                        <span
                                                            class="text-secondary">€0,00</span>
                                                    </li>

                                                    <li
                                                        class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
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
                        <!-- End On Target Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
