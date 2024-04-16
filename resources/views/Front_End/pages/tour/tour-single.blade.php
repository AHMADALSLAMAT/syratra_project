@extends('Front_End.layout.main_desgin')
@section('title',$package->name )
@section('content')
<main id="content">

    <div class="mb-4 mb-lg-8">
        <img class="img-fluid"
        src="{{ asset($package->image) }}"
        alt="Image" style="width: 100vw;height:500px;object-fit:cover;object-position:center center">
        <div class="container">
            <div class="position-relative">
                <div class="position-absolute right-0 mt-md-n11 mt-n9">
                    <div class="flex-horizontal-center">
                        <a class="js-fancybox btn btn-white transition-3d-hover ml-2 py-2 px-md-5 px-3 shadow-6"
                            href="javascript:;" data-src="{{ asset($package->image) }}"
                            data-fancybox="fancyboxGallery6"
                            data-caption="MyTravel in frames - image #01"
                            data-speed="700">
                            <i class="flaticon-gallery mr-md-2 font-size-18 text-primary"></i>
                            <span class="d-none d-md-inline">Gallery</span>
                        </a>
                        @foreach ($package->gallery as $item)
                        <img class="js-fancybox d-none" alt="Image Description" data-fancybox="fancyboxGallery6"
                            data-src="{{ asset($item) }}" data-caption="MyTravel in frames - image #02"
                            data-speed="700">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="d-block d-md-flex flex-center-between align-items-start mb-3">
                    <div class="mb-1">
                        <div class="mb-2 mb-md-0">
                            <h4 class="font-size-23 font-weight-bold mb-1 mr-3">{{$package->name}}</h4>
                        </div>
                        <div class="d-block d-xl-flex flex-horizontal-center">
                            <div class="d-block d-md-flex flex-horizontal-center font-size-14 text-gray-1 mb-2 mb-xl-0">
                                <i class="icon flaticon-placeholder mr-2 font-size-20"></i>
                                {{ \App\Helpers\MyFunctions::getCityName($package->loca_city,'city') }},
                                {{ \App\Helpers\MyFunctions::getCountryName($package->loca_country,'country')  }}
                                <a href="{{ $package->map }}" class="ml-1 d-block d-md-inline"> - View on map</a>
                            </div>
                            <div class="mr-4 mb-2 mb-md-0 flex-horizontal-center">
                                <div class="ml-xl-3 font-size-10 letter-spacing-2">
                                    <span class="d-block green-lighter ml-1">
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-borderless list-group-horizontal custom-social-share">
                        <li class="list-group-item px-1">
                            <a href="#" class="height-45 width-45 border rounded border-width-2 flex-content-center">
                                <i class="flaticon-like font-size-18 text-dark"></i>
                            </a>
                        </li>
                        <li class="list-group-item px-1">
                            <a href="#" class="height-45 width-45 border rounded border-width-2 flex-content-center">
                                <i class="flaticon-share font-size-18 text-dark"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="py-4 border-top border-bottom mb-4">
                    <ul class="list-group list-group-borderless list-group-horizontal row">
                        @foreach ($package->amenities_title as $key => $amenities_title)
                        <li class="col-md-4 flex-horizontal-center list-group-item text-lh-sm mb-2">
                            <img src="{{ asset($package->amenities_icon[$key])}}" width="50" alt="{{ $amenities_title }}" srcset="">
                            <div class="ml-1 text-gray-1">{{ $amenities_title }}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-bottom position-relative">
                    <h5 class="font-size-21 font-weight-bold text-dark mb-3">
                        Description
                    </h5>
                    <p class="mb-4">{!! $package->description_full !!}</p>
                </div>

                <div class="border-bottom py-4">
                    <h5 class="font-size-21 font-weight-bold text-dark mb-4">
                        Itinerary
                    </h5>
                    <div id="basicsAccordion1">
                        @foreach ($package->itinerary_Day as $key => $itinerary_Day)
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-header border-bottom-0 p-0" id="basicsHeadingOne{{ $key }}">
                                <h5 class="mb-0">
                                    <button type="button"
                                        class="collapse-link btn btn-link btn-block d-flex align-items-md-center font-weight-bold p-0"
                                        data-toggle="collapse"
                                        data-target="#basicsCollapseOne{{ $key }}"
                                        aria-expanded="false"
                                        aria-controls="basicsCollapseOne{{ $key }}">
                                        <div class="text-primary font-size-22 mb-3 mb-md-0 mr-3">
                                            <i class="far fa-circle"></i>
                                        </div>
                                        <div class="text-primary flex-shrink-0">
                                            {{ $itinerary_Day }}
                                            <span class="px-2">-</span>
                                        </div>
                                        <h6 class="font-weight-bold text-gray-3 text-left mb-0">
                                            {{ $package->itinerary_title[$key] }}
                                        </h6>
                                    </button>
                                </h5>
                            </div>
                            <div
                            id="basicsCollapseOne{{ $key }}"
                            class="collapse"
                            aria-labelledby="basicsHeadingOne{{ $key }}"
                                data-parent="#basicsAccordion{{ $key }}">
                            <div class="card-body pl-6 pb-0 pt-0">
                                <p class="mb-0">
                                    {!! $package->itinerary_desc[$key] !!}
                                </p>
                            </div>
                            </div>
                        </div>
                        <!-- End Card -->
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="mb-4">
                     <!-- START THE FORM BOOKING -->
                    @include('Front_End.pages.tour.formbooking.tour-form-booking')
                     <!-- END THE FORM BOOKING -->
                </div>
                <div class="mb-4">
                    @include('Front_End.pages.reviews.review-package')
                </div>
            </div>
        </div>
        <!-- Product Cards carousel -->
        <div class="product-card-carousel-block product-card-carousel-v5">
            <div class="space-1">
                <div class="w-md-80 w-lg-50 text-center mx-md-auto mt-3">
                    <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">You might also
                        like...</h2>
                </div>
                <div class="js-slick-carousel u-slick u-slick--equal-height u-slick--gutters-3" data-slides-show="4"
                    data-slides-scroll="1"
                    data-arrows-classes="d-none d-xl-inline-block u-slick__arrow-classic v1 u-slick__arrow-classic--v1 u-slick__arrow-centered--y rounded-circle"
                    data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left shadow-5"
                    data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right shadow-5"
                    data-pagi-classes="text-center d-xl-none u-slick__pagination mt-4" data-responsive='[{
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
                    @foreach ($related_package as $related)
                    <div class="js-slide py-3">
                        <div class="card transition-3d-hover shadow-hover-2 w-100 mt-2">
                            <div class="position-relative">
                                <a href="{{ route('singletour',$related->slug) }}"
                                    class="d-block gradient-overlay-half-bg-gradient-v5">
                                    <img class="card-img-top" src="{{ asset($related->image) }}"
                                        alt="Image Description" style="height: 300px;object-fit:cover">
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
                                    class="card-title font-size-17 font-weight-medium text-dark">{{ $related->name }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Product Cards carousel -->
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function () {
      // Initial package price
      var offerPrice = parseFloat("{{ $package->offer_price }}");
      var basedPrice = parseFloat("{{ $package->price }}");

      if(offerPrice > 0 ){
        basePrice = offerPrice;
      }else{
        basePrice = basedPrice;
      }

      // Function to update total price based on quantity
    function updateTotalPrice() {
        var adults = parseInt($("#adultsQty").val());
        var children = parseInt($("#childrenQty").val());
        var infants = parseInt($("#infantQty").val());

        var totalPrice = basePrice * adults + basePrice * 0.7 * children + basePrice * 0.2 * infants;

        // Update the total price display
        $("#totalPrice").text(totalPrice.toFixed(2) + " $ / Per Person");
        $("#fullPrice").val(totalPrice.toFixed(2));
    }

      // Event listeners for quantity changes
    $(".js-quantity a.js-minus").on("click", function (e) {
        e.preventDefault();
        var input = $(this).siblings("input");
        var currentValue = parseInt(input.val(), 10);  // Explicitly convert to a number
        if (currentValue > input.attr("min")) {
          input.val(currentValue );

        }else {
        // If value is 0, set it back to the original value
        input.val(0);
      }
      updateTotalPrice();
    });

        $(".js-quantity a.js-plus").on("click", function (e) {
            e.preventDefault();
            var input = $(this).siblings("input");
            var currentValue = parseInt(input.val(), 10);  // Explicitly convert to a number
            if (currentValue < input.attr("max")) {
            input.val(currentValue);
            updateTotalPrice();
            }
        });

      // Initial update
      updateTotalPrice();
    });
  </script>
  <!-- Add the JavaScript function to submit the form -->
<script>
    function submitForm() {
        var packageId = document.getElementById('pakcage_id').value;
        var adults = document.getElementById('adultsQty').value;
        var children = document.getElementById('childrenQty').value;
        var infant = document.getElementById('infantQty').value;
        var fullPrice = document.getElementById('fullPrice').value;

        var url = "{{ route('toursbooking', $package->id) }}?package_id="+ packageId +"&price="+ fullPrice +"&adults=" + adults + "&children=" + children + "&infant=" + infant;
        window.location.href = url;
    }
</script>
@stop
