@extends('Front_End.layout.main_desgin')
@section('title',$hotel->hotel_name )
@section('content')

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-block d-md-flex flex-center-between align-items-start mb-2">
                            <div class="mb-3">
                                <ul class="list-unstyled mb-2 d-md-flex flex-lg-wrap flex-xl-nowrap mb-2">
                                    <li
                                        class="border border-brown bg-brown rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 mr-md-2 mb-2 mb-md-0 mb-lg-2 mb-xl-0">
                                        <span class="font-weight-normal text-white font-size-14">Newly renovated</span>
                                    </li>
                                    <li
                                        class="border border-maroon bg-maroon rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 mr-md-2 mb-2 mb-md-0 mb-lg-2 mb-xl-0 mb-md-0">
                                        <span class="font-weight-normal font-size-14 text-white">Free Wi-Fi</span>
                                    </li>
                                </ul>
                                <div class="d-block d-md-flex flex-horizontal-center mb-2 mb-md-0">
                                    <h4 class="font-size-23 font-weight-bold mb-1">{{ $hotel->hotel_name }}</h4>
                                    <div class="ml-3 font-size-10 letter-spacing-2">
                                        <span class="d-block green-lighter ml-1">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-block d-md-flex flex-horizontal-center font-size-14 text-gray-1">
                                    <i class="icon flaticon-placeholder mr-2 font-size-20"></i>
                                    {{ \App\Helpers\MyFunctions::getCityName($hotel->loca_city,'city') }},
                                    {{ \App\Helpers\MyFunctions::getCountryName($hotel->loca_country,'country')  }}
                                    <a href="{{ $hotel->hotel_map }}" class="ml-1 d-block d-md-inline"> - View on map</a>
                                </div>
                            </div>

                        </div>
                        <div class="pb-4 mb-2">
                            <div class="position-relative">
                                <!-- Images Carousel -->
                                <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                                    data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                    data-arrow-left-classes="flaticon-back u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                    data-arrow-right-classes="flaticon-next u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                    data-nav-for="#sliderSyncingThumb">
                                    @foreach ($hotel->hotel_gallery  as $gallery)
                                    <div class="js-slide">
                                        <img class="img-fluid border-radius-3" src="{{ asset($gallery) }}"
                                            alt="Image Description" style="width:100%;height:600px;object-fit:cover">
                                    </div>
                                    @endforeach
                                </div>

                                <div id="sliderSyncingThumb"
                                    class="js-slick-carousel u-slick u-slick--gutters-4 u-slick--transform-off"
                                    data-infinite="true" data-slides-show="6" data-is-thumbs="true"
                                    data-nav-for="#sliderSyncingNav" data-responsive='[{
                                        "breakpoint": 992,
                                        "settings": {
                                            "slidesToShow": 4
                                        }
                                    }, {
                                        "breakpoint": 768,
                                        "settings": {
                                            "slidesToShow": 3
                                        }
                                    }, {
                                        "breakpoint": 554,
                                        "settings": {
                                            "slidesToShow": 2
                                        }
                                    }]'>
                                    @foreach ($hotel->hotel_gallery  as $gallery)

                                    <div class="js-slide" style="cursor: pointer;">
                                        <img class="img-fluid border-radius-3 height-110"
                                        src="{{ asset($gallery) }}" alt="Image Description">
                                    </div>
                                    @endforeach

                                </div>
                                <!-- End Images Carousel -->
                            </div>
                        </div>
                        <div class="border-bottom position-relative">
                            <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark">
                                Description
                            </h5>
                            <p>{!! $hotel->hotel_description_full !!}</p>
                        </div>
                        <div class="border-bottom py-4">
                            <h5 id="scroll-amenities" class="font-size-21 font-weight-bold text-dark mb-4">
                                Select Your Room
                            </h5>
                            @foreach ($hotel->Rooms as $room)
                            <div class="card border-color-7 mb-5 overflow-hidden">
                                <div class="position-absolute top-0 right-0 mr-md-1 mt-md-1">
                                    @if($room->discound > 0)
                                    <div
                                        class="border border-brown bg-brown rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 mr-2 mt-2">
                                        <span class="font-weight-normal text-white font-size-14">
                                           Discound {{$room->discound}}%
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                <div class="product-item__outer w-100">
                                    <div class="row">
                                        <div class="col-md-5 col-lg-5 col-xl-3dot5">
                                            <div class="pt-5 pb-md-5 pl-4 pr-4 pl-md-5 pr-md-2 pr-xl-2">
                                                <div class="product-item__header mt-2 mt-md-0">
                                                    <div class="position-relative">
                                                        <img class="img-fluid rounded-sm"
                                                            src="{{ asset($room->room_image) }}"
                                                            alt="Image Description">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-7 col-lg-7 col-xl-5 flex-horizontal-center pl-xl-0">
                                            <div class="w-100 position-relative m-4 m-md-0">
                                                <a href="{{ route('hotelbooking',$room->id) }}" class="mb-2 d-inline-block">
                                                    <span
                                                        class="font-weight-bold font-size-17 text-dark text-dark">{{$room->room_type}}</span>
                                                </a>
                                                <div class="mt-1 pt-2">
                                                    <div class=" mb-1">
                                                        <div class="aminate">
                                                            <ul class="list-unstyled mb-0 row">
                                                                @foreach ($room->room_amenities_title as $key => $room_amenities)
                                                                <li class="media col-md-6 mb-3 text-gray-1">
                                                                    <small class="mr-2">
                                                                       <img src="{{ asset($room->room_amenities_icon[$key]) }}" style="width: 30px" alt="">
                                                                    </small>
                                                                    <div class="media-body font-size-1 ml-1">
                                                                        {{ $room_amenities }}
                                                                    </div>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col col-xl-3dot5 align-self-center py-4 py-xl-0 border-top border-xl-top-0">
                                            <div
                                                class="flex-content-center border-xl-left py-xl-5 ml-4 ml-xl-0 justify-content-start justify-content-xl-center">
                                                <div class="text-center my-xl-1">
                                                    <div class="mb-2 pb-1">
                                                        <span class="font-size-14">From </span>
                                                        <span class="font-weight-bold font-size-22 ml-1">
                                                            @if ($room->offer_price > 0)
                                                            {{ $room->offer_price }}$ -
                                                           <del ><small  style="color:red">{{ $room->room_price }}$ </small></del>
                                                            @else

                                                            {{ $room->room_price }}$
                                                            @endif
                                                        </span>
                                                        <span class="font-size-14"> / night</span>
                                                    </div>
                                                    <a href="{{ route('hotelbooking', $room->id) }}"
                                                        class="btn btn-outline-primary border-radius-3 border-width-2 px-4 font-weight-bold min-width-200 py-2 text-lh-lg">Book
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <h5 id="scroll-amenities" class="font-size-21 font-weight-bold text-dark mb-4">
                                Amenities
                            </h5>
                            <ul
                                class="list-group list-group-borderless list-group-horizontal list-group-flush no-gutters row">
                                @foreach ($hotel->hotel_amenities_title as $key => $hotel_amenities)
                                <li class="col-md-4 list-group-item">
                                    <img src="{{ asset($hotel->hotel_amenities_icon[$key]) }}" style="width:50px" alt="">
                                        {{ $hotel_amenities }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="mb-4">
                            <div class="flex-horizontal-center">
                                <ul
                                    class="ml-n1 list-group list-group-borderless list-group-horizontal custom-social-share">
                                    <li class="list-group-item px-1 py-0">
                                        <a href="#"
                                            class="height-45 width-45 border rounded border-width-2 flex-content-center">
                                            <i class="flaticon-like font-size-18 text-dark"></i>
                                        </a>
                                    </li>
                                    <li class="list-group-item px-1 py-0">
                                        <a href="#"
                                            class="height-45 width-45 border rounded border-width-2 flex-content-center">
                                            <i class="flaticon-share font-size-18 text-dark"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="flex-horizontal-center ml-2">
                                    <div class="badge-primary rounded-xs px-1">
                                        <span class="badge font-size-19 px-2 py-2 mb-0 text-lh-inherit">4.6 /5 </span>
                                    </div>

                                    <div class="ml-2 text-lh-1">
                                        <div class="ml-1">
                                            <h4 class="text-primary font-size-17 font-weight-bold mb-0">Excellent</h4>
                                            <span class="text-gray-1 font-size-14">(1,186 Reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled d-md-flex mb-5">
                            <li
                                class="border border-violet-1 bg-violet-1 rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 mb-2 mb-md-0">
                                <span class="font-weight-normal font-size-14 text-white">Lowest price includes</span>
                            </li>
                            <li
                                class="border border-violet-1 rounded-xs d-flex align-items-center text-lh-1 py-1 px-4 ml-md-n1 mb-2 mb-md-0">
                                <span class="font-weight-normal font-size-14 text-violet-1">Free breakfast</span>
                            </li>
                        </ul>
                        <div class="mb-4">
                            <div class="border border-color-7 rounded px-4 pt-4 pb-3 mb-5">
                                <div class="px-2 pt-2">
                                    <a href="{{ $hotel->hotel_map }}" class="d-block border rounded mb-4">
                                        <img class="img-fluid" src="{{ asset('front_assest/assets/img/map-markers/map.jpg') }}"
                                            alt="Image-Description">
                                    </a>
                                    <div class="flex-horizontal-center mb-4">
                                        <div class="border-primary border rounded-xs px-3 text-lh-1dot7 py-1">
                                            <span
                                                class="font-size-21 font-weight-bold px-1 mb-0 text-lh-inherit text-primary">4.5</span>
                                        </div>

                                        <div class="ml-2 text-lh-1">
                                            <div class="ml-1">
                                                <h4 class="text-primary font-size-17 font-weight-bold mb-0">Exceptional
                                                </h4>
                                                <span class="text-gray-1 font-size-14">Location rating score</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="flaticon-placeholder-1 font-size-25 text-primary mr-3 pr-1"></i>
                                        <h6 class="mb-0 font-size-14 text-gray-1">
                                            <a href="#">Better than 99% of properties in London</a>
                                        </h6>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="flaticon-medal font-size-25 text-primary mr-3 pr-1"></i>
                                        <h6 class="mb-0 font-size-14 text-gray-1">
                                            <a href="#">Exceptional location - Inside city center</a>
                                        </h6>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="flaticon-home font-size-25 text-primary mr-3 pr-1"></i>
                                        <h6 class="mb-0 font-size-14 text-gray-1">
                                            <a href="#">Popular neighborhood</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('Front_End.pages.reviews.review-form')
                        </div>
                    </div>
                </div>
                <!-- Product Cards Ratings With carousel -->
                <div class="product-card-block product-card-v3">
                    <div class="space-1">
                        <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-4">
                            <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">RELATED HOTELS</h2>
                        </div>
                        <div class="js-slick-carousel u-slick u-slick--equal-height u-slick--gutters-3"
                            data-slides-show="4" data-slides-scroll="1"
                            data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic v1 u-slick__arrow-classic--v1 u-slick__arrow-centered--y rounded-circle"
                            data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left"
                            data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right"
                            data-pagi-classes="d-lg-none text-center u-slick__pagination mt-4" data-responsive='[{
                                "breakpoint": 1025,
                                "settings": {
                                    "slidesToShow": 3
                                }
                            }, {
                                "breakpoint": 992,
                                "settings": {
                                    "slidesToShow": 2
                                }
                            }, {
                                "breakpoint": 768,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }, {
                                "breakpoint": 554,
                                "settings": {
                                    "slidesToShow": 1
                                }
                            }]'>
                            @foreach ($related_hotel as $related)
                            <div class="js-slide py-3">
                                <div class="card transition-3d-hover shadow-hover-2 w-100 mt-2">
                                    <div class="position-relative">
                                        <a href="{{ route('singlehotel',$related->slug) }}"
                                            class="d-block gradient-overlay-half-bg-gradient-v5">
                                            <img class="card-img-top" src="{{ asset($related->hotel_image) }}"
                                                alt="Image Description">
                                        </a>
                                        <div class="position-absolute top-0 right-0 pt-3 pr-3">
                                            <button type="button" class="btn btn-sm btn-icon text-white rounded-circle"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Save for later">
                                                <span class="flaticon-heart-1 font-size-20"></span>
                                            </button>
                                        </div>
                                        <div class="position-absolute bottom-0 left-0 right-0">
                                            <div class="px-4 pb-3">
                                                <a href="../hotels/hotel-single-v1.html" class="d-block">
                                                    <div class="d-flex align-items-center font-size-14 text-white">
                                                        <i class="icon flaticon-placeholder mr-2 font-size-20"></i>
                                                        {{ \App\Helpers\MyFunctions::getCityName($related->loca_city,'city') }},
                                                        {{ \App\Helpers\MyFunctions::getCountryName($related->loca_country,'country')  }}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-4 pt-2 pb-3">
                                        <div class="mb-2">
                                            <div
                                                class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary letter-spacing-3">
                                                <div class="green-lighter">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('singlehotel',$related->slug) }}"
                                            class="card-title font-size-17 font-weight-medium text-dark">{{ $related->hotel_name }}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- End Product Cards Ratings With carousel -->
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
@endsection
