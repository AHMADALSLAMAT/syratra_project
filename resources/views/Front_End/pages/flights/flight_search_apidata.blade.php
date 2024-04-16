@extends('Front_End.layout.main_desgin')
@section('title','Flights Page')
@section('content')
<main id="content" role="main">
    <div class="bg-gray-33 py-1">
        <div class="container">
            <div class="border-0">
                <div class="card-body">
                    <ul class="nav tab-nav tab-nav-1-inner flex-nowrap pb-2 mb-md-1 px-lg-3 px-2" role="tablist">
                    </ul>
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
                    @include('Front_End.pages.filters.flight_api')
                </div>
            </div>
            <div class="col-xl-9 mt-xl-1">
                <!-- Shop-control-bar Title -->
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 pb-1">
                    <h3 class="font-size-21 font-weight-bold mb-4 mb-md-0 text-lh-1 text-center text-md-left">
                     {{ count($result) }}   results found.</h3>
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
                <!-- End shop-control-bar Title -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                        @foreach ($result as $apiFlight)
                        @foreach ($apiFlight['itineraries'] as $item)
                        <div class="mb-5">
                            <div class="hover-bg-gray-1 border rounded-xs py-4 px-4 px-xl-5">
                                <div class="row align-items-center text-center">
                                    <div class="col-md mb-4 mb-md-0">
                                        {{--<img class="img-fluid"
                                             src="{{ asset('uploade/airline_logo/184639_W4.png') }}"
                                             alt="Image-Description"
                                             width="100px">--}}
                                             <h6>{{ $apiFlight['validatingAirlineCodes'][0]['businessName'] }}</h6>
                                    </div>
                                        <div class="col-md mb-4 mb-md-0">
                                            <div class="flex-content-center d-block d-lg-flex">
                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                    <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                                </div>
                                                <div class="text-lg-left">
                                                    <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                      {{ $item['departuredate'] }}
                                                    </h6>
                                                    <span class="font-size-10 text-gray-1">
                                                        {{ $item['departureiataCode'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-md mb-4 mb-md-0">
                                            <div class="flex-content-center flex-column">
                                                <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                                    {{ $item['diffrenceHours'] }}
                                                </h6>
                                                <div class="width-60 border-top border-primary border-width-2 my-1">
                                                </div>
                                                @if ($item['numberOfStops'] > 0 )
                                                <div class="font-size-14 text-gray-1">
                                                    {{ $item['numberOfStops'] }} Stop
                                                </div>
                                                @else
                                                <div class="font-size-14 text-gray-1">Non Stop</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class=" col-md mb-4 mb-md-0">
                                            <div class="flex-content-center d-block d-lg-flex">
                                                <div class="mr-lg-3 mb-1 mb-lg-0">
                                                    <i
                                                        class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                                </div>
                                                <div class="text-lg-left">
                                                    <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                        {{ $item['arrivaldate'] }}
                                                    </h6>
                                                    <span class="font-size-10 text-gray-1">
                                                        {{ $item['arrivaliataCode'] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-2gdot8">
                                        <div class="border-xl-left">
                                            <div class="ml-xl-5">
                                                <div class="mb-2">
                                                    <div class="mb-2 text-lh-1dot4">
                                                        <span
                                                            class="font-weight-bold font-size-22">{{ $apiFlight ['price']['total'] }} {{ $apiFlight['price']['currency'] }}</span>
                                                    </div>
                                                    <a href="{{ route('flightbooking') }}"
                                                        class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100">Book Now</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofKuLzoUp+9msz0NlJZ+uaG5pfabzZOrO" crossorigin="anonymous"></script>
