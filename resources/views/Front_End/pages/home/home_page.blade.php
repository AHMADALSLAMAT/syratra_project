@extends('Front_End.layout.main_desgin')
@section('home_header','home_header')
@section('preload','preload')
@section('title','Home Page')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content">
    <!-- ========== HERO ========== -->
    <div class="hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2"
        style="background-image: url(../../front_assest/assets/travel_images/bsr-travel-hero.jpg);">
        <div class="container space-2 space-top-xl-9">
            <div class="row justify-content-md-center pb-xl-8">
                <!-- Info -->
                <div class="py-8 py-xl-10 pb-5">
                    <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold">Let's The World
                        Together!</h1>
                    <p class="font-size-20 font-weight-normal text-white">Find awesome hotel, tour, car and
                        activities Over The World</p>
                </div>
                <!-- End Info -->
            </div>
            <!-- Search bar for travel -->
            @include('Front_End.layout.searchbar')
        </div>
    </div>
    <!-- ========== END HERO ========== -->
    <!-- Destinantion v1 -->
    <div class="destinantion-block destinantion-v1 border-bottom border-color-8">
        <div class="container space-bottom-1 space-top-lg-3">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mt-4">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">Hot Deals</h2>
            </div>
            <div class="row mb-1">
                @foreach ($countsByCountry as $key=> $item)
                <!-- Card Block -->
                <div class="col-md-6 col-xl-3 mb-3 mb-md-4">
                    <div class="min-height-350 bg-img-hero rounded-border p-5
                    gradient-overlay-half-bg-gradient transition-3d-hover shadow-hover-2 border-0 dropdown"
                        style="background-image: url(../../front_assest/assets/travel_images/img{{ $key + 1 }}-2.jpeg);">
                        <div class="w-100 d-flex justify-content-between mb-2">
                            <div class="position-relative">
                                <a href="../others/destination.html"
                                    class="destination text-white font-weight-bold font-size-21 pb-3
                                    mb-3 text-lh-1 d-block">{{ \App\Helpers\MyFunctions::getCountryName($item->loca_country,'country')  }}</a>

                                <!-- Dropdown List -->
                                <div class="destination-dropdown v1">
                                    <a class="dropdown-item" href="{{ route('view_hotel') }}">{{ $item->hotel_count }} Hotel</a>
                                    <a class="dropdown-item" href="{{ route('view_tour') }}">{{ $item->package_count }} Tour</a>
                                </div>
                                <!-- End Dropdown List -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card Block -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Destinantion v1 -->

    <!-- Tabs v1 -->
    <div class="tabs-block tab-v1">
        <div class="container space-1">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto my-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">TREDING HOTELS</h2>
            </div>
            <!-- Nav Classic -->
            <ul class="nav tab-nav-pill flex-nowrap pb-4 pb-lg-5 tab-nav justify-content-lg-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-medium active" id="pills-one-example-t1-tab" data-toggle="pill"
                        href="#pills-one-example-t1" role="tab" aria-controls="pills-one-example-t1"
                        aria-selected="true">
                        <div class="d-flex flex-column flex-md-row  position-relative text-dark align-items-center">
                            <span class="tabtext font-weight-semi-bold">HOTELS</span>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- End Nav Classic -->
            <div class="tab-content">

                <div class="tab-pane fade active show" id="pills-one-example-t1" role="tabpanel"
                    aria-labelledby="pills-one-example-t1-tab">
                    <div class="row">
                        @foreach ($hotels as $hotel)
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
                            <div class="card mb-1 transition-3d-hover shadow-hover-2 tab-card h-100">
                                <div class="position-relative mb-2">
                                    <a href="{{ route('singlehotel',$hotel->slug) }}"
                                        class="d-block gradient-overlay-half-bg-gradient-v5">
                                        <img class="card-img-top" src="{{ asset($hotel->hotel_image) }}"
                                            alt="img" style="height: 300px;object-fit:cover">
                                    </a>

                                    <div class="position-absolute top-0 left-0 pt-5 pl-3">
                                        <span
                                            class="badge badge-pill bg-white text-primary px-4 py-2 font-size-14 font-weight-normal">Rooms</span>
                                        <span
                                            class="badge badge-pill bg-white text-danger px-3 ml-3 py-2 font-size-14 font-weight-normal">{{$hotel->hotel_rooms }}</span>
                                    </div>
                                </div>
                                <div class="card-body px-4 py-2">
                                    <a href="{{ $hotel->hotel_map }}" class="d-block">
                                        <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                                            <i class="icon flaticon-pin-1 mr-2 font-size-15"></i>
                                            {{ \App\Helpers\MyFunctions::getCityName($hotel->loca_city,'city') }},
                                            {{ \App\Helpers\MyFunctions::getCountryName($hotel->loca_country,'country')  }}
                                        </div>
                                    </a>
                                    <a href="{{ route('singlehotel',$hotel->slug) }}"
                                        class="card-title font-size-17 font-weight-bold mb-0 text-dark">{{$hotel->hotel_name}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Tabs v1 -->
<!-- Tabs v1 -->
<div class="tabs-block tab-v1">
    <div class="container space-1">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto my-3">
            <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">TREDING TOURS</h2>
        </div>
        <!-- Nav Classic -->
        <ul class="nav tab-nav-pill flex-nowrap pb-4 pb-lg-5 tab-nav justify-content-lg-center" role="tablist">

            <li class="nav-item">
                <a class="nav-link font-weight-medium active" id="pills-two-example-t1-tab" data-toggle="pill"
                    href="#pills-two-example-t1" role="tab" aria-controls="pills-two-example-t1"
                    aria-selected="true">
                    <div class="d-flex flex-column flex-md-row  position-relative text-dark align-items-center">
                        <span class="tabtext font-weight-semi-bold">TOURS</span>
                    </div>
                </a>
            </li>
        </ul>
        <!-- End Nav Classic -->
        <div class="tab-content">
            <div class="tab-pane fade active show" id="pills-two-example-t1" role="tabpanel"
                aria-labelledby="pills-two-example-t1-tab">
                <div class="row">
                    @foreach ($packages as $package)
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
                        <div class="card mb-1 transition-3d-hover shadow-hover-2 tab-card h-100">
                            <div class="position-relative mb-2">
                                <a href="{{ route('singletour',$package->slug) }}"
                                    class="d-block gradient-overlay-half-bg-gradient-v5">
                                    <img class="card-img-top" src="{{ asset($package->image) }}"
                                        alt="img" style="height: 300px;object-fit:cover">
                                </a>
                                @if($package->discound > 0)
                                <div class="position-absolute top-0 left-0 pt-5 pl-3">
                                    <span
                                        class="badge badge-pill bg-white text-danger px-3 ml-3 py-2 font-size-14 font-weight-normal">%{{ $package->discound }}</span>
                                </div>
                                @endif

                                <div class="position-absolute bottom-0 left-0 right-0">
                                    <div class="justify-content-between align-items-center">
                                        <div class="px-3 pb-2">
                                            <span class="text-white font-weight-normal font-size-14">For {{ $package->days }} DAYS</span>
                                            <h2 class="h5 text-white mb-0 font-weight-bold"><small
                                                    class="mr-2">From</small>{{ $package->price }} $</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-4 py-2">
                                <a href="{{ route('singletour',$package->slug) }}" class="d-block">
                                    <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                                        <i class="icon flaticon-pin-1 mr-2 font-size-15"></i>
                                        {{ \App\Helpers\MyFunctions::getCityName($package->loca_city,'city') }},
                                        {{ \App\Helpers\MyFunctions::getCountryName($package->loca_country,'country')  }}
                                    </div>
                                </a>
                                <a href="{{ route('singletour',$package->slug) }}"
                                    class="card-title text-dark font-size-17 font-weight-bold">{{$package->name}}</a>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Tabs v1 -->
    <!-- Banner v1-->
    <div class="banner-block banner-v1 bg-img-hero space-3"
        style="background-image: url(../../front_assest/assets/travel_images/img1-2.jpeg);">
        <div class="max-width-650 mx-auto text-center mt-xl-5 mb-xl-2 px-3 px-md-0">
            <h6 class="text-white font-size-40 font-weight-bold mb-1">Travel Tips</h6>
            <p class="text-white font-size-18 font-weight-normal mb-4 pb-1 px-md-3 px-lg-0">Northern Ireland’s
                is now contingent. Britain is getting a divorce Northern Ireland is being offered a trial
                separation for Britain there is a one</p>
            <a class="btn btn-outline-white border-width-2 rounded-xs min-width-200 font-weight-normal transition-3d-hover"
                href="../blog/blog-list.html">Get Inspired</a>
        </div>
    </div>
    <!-- End Banner v1-->

    <!-- Icon Block v1 -->
    <div class="icon-block-center icon-center-v1 border-bottom border-color-8">
        <div class="container text-center space-1">
            <!-- Title -->
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 mt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold">Why Choose</h2>
            </div>
            <!-- End Title -->

            <!-- Features -->
            <div class="mb-2">
                <div class="row">
                    <!-- Icon Block -->
                    <div class="col-md-4">
                        <i class="flaticon-price text-primary font-size-80 mb-3"></i>
                        <h5 class="font-size-17 text-dark font-weight-bold mb-2"><a href="#">Competitive
                                Pricing</a></h5>
                        <p class="text-gray-1 px-xl-2 px-uw-7">With 500+ suppliers and the purchasing power of
                            300 million members, mytravel.com can save you more!</p>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="col-md-4">
                        <i class="flaticon-medal text-primary font-size-80 mb-3"></i>
                        <h5 class="font-size-17 text-dark font-weight-bold mb-2"><a href="#">Award-Winning
                                Service</a></h5>
                        <p class="text-gray-1 px-xl-2 px-uw-7">Travel worry-free knowing that we're here if you
                            needus, 24 hours a day</p>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="col-md-4">
                        <i class="flaticon-global-1 text-primary font-size-80 mb-3"></i>
                        <h5 class="font-size-17 text-dark font-weight-bold mb-2"><a href="#">Worldwide
                                Coverage</a></h5>
                        <p class="text-gray-1 px-xl-2 px-uw-7">Over 1,200,000 hotels in more than 200 countries
                            and regions & flights to over 5,000 cities</p>
                    </div>
                    <!-- End Icon Block -->
                </div>
            </div>
            <!-- End Features -->
        </div>
    </div>
    <!-- End Icon Block v1 -->

</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection
