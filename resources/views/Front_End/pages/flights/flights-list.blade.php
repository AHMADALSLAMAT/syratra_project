@extends('Front_End.layout.main_desgin')
@section('title','Flights Page')
@section('content')
<main id="content" role="main">
    <div class="bg-gray-33 py-1">
        <div class="container">
            <div class="border-0">
                <div class="card-body">
                    <ul class="nav tab-nav tab-nav-1-inner flex-nowrap pb-2 mb-md-1 px-lg-3 px-2" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-shrink-md-1">
                            <a class="nav-link font-weight-medium active" id="pills-one-example2-tab" data-toggle="pill"
                                href="#pills-one-example2" role="tab" aria-controls="pills-one-example2"
                                aria-selected="true">
                                <div
                                    class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                    <span class="tabtext font-size-12 font-weight-semi-bold">ROUND-TRIP</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content hero-tab-pane">
                        @include('Front_End.pages.flights.flight_searchform')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row pt-5 pt-xl-8 mb-5 mb-xl-9 pb-xl-1">
            <div class="col-lg-4 col-xl-3 mt-xl-1">
                <div class="navbar-expand-xl navbar-expand-xl-collapse-block">
                    <button class="btn d-xl-none mb-5 p-0 collapsed" type="button" data-toggle="collapse"
                        data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                        <span class="text-primary ml-2">Sidebar</span>
                    </button>
                    @include('Front_End.pages.filters.flight_filter')
                </div>
            </div>
            <div class="col-xl-9 mt-xl-1">
                <!-- Shop-control-bar Title -->
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 pb-1">
                    <h3 class="font-size-21 font-weight-bold mb-4 mb-md-0 text-lh-1 text-center text-md-left">
                        FLIGHTS YOU WOULD LIKE</h3>
                    <div class="d-flex align-items-center justify-content-between justify-content-md-start">
                        <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-size-22 p-0 ml-4 active" id="pills-three-example1-tab"
                                    data-toggle="pill" href="#pills-three-example1" role="tab"
                                    aria-controls="pills-three-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border mb-5 rounded">
                    <div class="js-slick-carousel u-slick px-9" data-slides-show="5" data-slides-scroll="1"
                        data-arrows-classes="u-slick__arrow-classic__v1 u-slick__arrow-centered--y h-100 width-70 z-index-2 bg-white cursor-pointer font-size-20"
                        data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left rounded-left"
                        data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right rounded-right"
                        data-responsive='[{
                                    "breakpoint": 992,
                                    "settings": {
                                        "slidesToShow": 3
                                    }
                                }, {
                                    "breakpoint": 768,
                                    "settings": {
                                        "slidesToShow": 2
                                    }
                                }, {
                                    "breakpoint": 554,
                                    "settings": {
                                        "slidesToShow": 1
                                    }
                                }]'>
                        @foreach ($formattedFlights as $item)
                        @php
                            if($item->offer_price > 0){
                            $price = $item->offer_price;
                            }else{
                            $price = $item->flight_price;
                            }

                        @endphp
                        <div class="js-slide">
                            <div class="py-3 border-right text-hover-primary">
                                <div class="text-center py-1">
                                    <a href="#">
                                        <h6 class="font-weight-bold text-gray-3 mb-0">
                                            {{ Illuminate\Support\Carbon::parse($item->flight_leave_date)->format('D, d M') }}
                                        </h6>
                                        <span class="font-weight-normal text-gray-1">{{ $price }} $</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- End shop-control-bar Title -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                        @foreach ($flights as $flight)
                        @php


                        @endphp
                        <div class="mb-5">
                            <div class="hover-bg-gray-1 border rounded-xs py-4 px-4 px-xl-5">
                                <div class="row align-items-center text-center">
                                    <div class="col-md mb-4 mb-md-0">
                                        <img class="img-fluid" src="{{ asset($flight->airlines->airline_logo) }}"
                                            alt="Image-Description" width="100px">
                                    </div>
                                    <div class="col-md mb-4 mb-md-0">
                                        <div class="flex-content-center d-block d-lg-flex">
                                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                                <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                            </div>
                                            <div class="text-lg-left">
                                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                    {{ $flight->flight_leave_hours }}
                                                </h6>
                                                <span
                                                    class="font-size-10 text-gray-1">{{ \App\Helpers\MyFunctions::getAirportData($flight->flight_leave_airport,'name')  }}({{ $flight->flight_leave_airport }})</span><br>
                                                    <span class="font-size-10 text-gray-1">
                                                        {{ $flight->flight_leave_date }}
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md mb-4 mb-md-0">
                                        <div class="flex-content-center flex-column">
                                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                                {{ App\Helpers\Flight::calculateHoursDifference(
                                                            $flight->flight_leave_date,$flight->flight_leave_hours,
                                                            $flight->flight_arrive_date,$flight->flight_arrive_hours) }}
                                            </h6>
                                            <div class="width-60 border-top border-primary border-width-2 my-1">
                                            </div>
                                            @if ($flight->flight_stops > 0 )
                                            <div class="font-size-14 text-gray-1">
                                                {{ count($flight->flight_stops_country) }} Stop</div>
                                            @else
                                            <div class="font-size-14 text-gray-1">Non Stop</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md mb-4 mb-md-0">
                                        <div class="flex-content-center d-block d-lg-flex">
                                            <div class="mr-lg-3 mb-1 mb-lg-0">
                                                <i
                                                    class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                            </div>
                                            <div class="text-lg-left">
                                                <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                    {{ $flight->flight_arrive_hours }}
                                                </h6>
                                                <span class="font-size-10 text-gray-1">
                                                    {{ \App\Helpers\MyFunctions::getAirportData($flight->flight_arrive_airport,'name')  }}({{ $flight->flight_arrive_airport }})
                                                </span>
                                                <br>
                                                <span class="font-size-10 text-gray-1">
                                                    {{ $flight->flight_arrive_date }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2gdot8">
                                        <div class="border-xl-left">
                                            <div class="ml-xl-5">
                                                <div class="mb-2">
                                                    <div>
                                                        @if ($flight->discound > 0)
                                                        <span class="badge badge-success"> Discound
                                                            {{ $flight->discound }}%</span>
                                                        @endif

                                                    </div>
                                                    <div class="mb-2 text-lh-1dot4">
                                                        @if($flight->offer_price > 0)
                                                        <span data-price="{{ $flight->offer_price }}"
                                                        class="font-weight-bold font-size-22">
                                                        {{ $flight->offer_price }}
                                                        $

                                                        </span>
                                                        <span class="badge badge-danger">
                                                            <del>
                                                                <small>  {{ $flight->flight_price}}$</small>
                                                            </del>
                                                        </span>
                                                            @else
                                                            <span data-price="{{ $flight->flight_price }}"
                                                            class="font-weight-bold font-size-22">
                                                            {{ $flight->flight_price}}
                                                            $
                                                            </span>
                                                            @endif

                                                    </div>
                                                    <a href="#" data-flight_leave="{{ $flight->id }}"
                                                        data-return_flight="{{ $flight->id }}"
                                                        class="btn booknowbtn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100">Book
                                                        Now</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $flights->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Send an Ajax request
    $(document).ready(function() {
        $('.booknowbtn').click(function (e) {
            e.preventDefault();
            var departure_flight_id = $(this).data('flight_leave');
            var return_flight_id = $(this).data('return_flight');
            $.ajax({
                type: "POST",
                url: "{{ route('flightbooking_post') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    departure_flight_id: departure_flight_id,
                    return_flight_id: return_flight_id
                },
                success: function(response) {

                    if (response.status == 401) {
                        window.location.href = "{{ route('front.login') }}"; // Assuming you're using a templating engine like Blade
                    } else {
                        if (response.status == 200) {
                            // Redirect to the flightbooking page
                            window.location.href = response.redirect;
                        } else {
                            // Handle other responses or actions
                            alert('something went wrong in your data flight');
                        }
                    }
                },
                error: function (response) {

                    if (response.status == 401) {
                        window.location.href = "{{ route('front.login') }}"; // Assuming you're using a templating engine like Blade
                    }
                }
            });
        });
    });
</script>

