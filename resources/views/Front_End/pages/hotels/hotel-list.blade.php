@extends('Front_End.layout.main_desgin')
@section('title','Hotel Page')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <div class="container pt-5 pt-xl-8">
        <div class="row mb-5 mb-lg-8 mt-xl-1">
            <div class="col-lg-4 col-xl-3 order-lg-1 width-md-50">
                <div class="navbar-expand-lg navbar-expand-lg-collapse-block">
                    <button class="btn d-lg-none mb-5 p-0 collapsed" type="button" data-toggle="collapse"
                        data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                        <span class="text-primary ml-2">Sidebar</span>
                    </button>
                    @include('Front_End.pages.filters.hotel_filter')
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 order-md-1 order-lg-2 pb-5 pb-lg-0">
                <!-- Shop-control-bar Title -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="font-size-21 font-weight-bold mb-0 text-lh-1">Results : {{ count($hotels) }} Hotels found</h3>
                    <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-size-22 p-0 active" id="pills-three-example1-tab"
                                data-toggle="pill" href="#pills-three-example1" role="tab"
                                aria-controls="pills-three-example1" aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-list"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End shop-control-bar Title -->

                <!-- Slick Tab carousel -->
                <div class="u-slick__tab">

                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-three-example1" role="tabpanel"
                            aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                            <ul class="d-block list-unstyled products-group prodcut-list-view">
                                @foreach ($hotels as $hotel)
                                <li class="card mb-5 overflow-hidden">
                                    <div class="product-item__outer w-100">
                                        <div class="row">
                                            <div class="col-md-5 col-xl-4">
                                                <div class="product-item__header">
                                                    <div class="position-relative">
                                                        <div class="js-slick-carousel u-slick u-slick--equal-height "
                                                            data-slides-show="1" data-slides-scroll="1"
                                                            data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic v4 u-slick__arrow-classic--v4 u-slick__arrow-centered--y rounded-circle"
                                                            data-arrow-left-classes="flaticon-back u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left"
                                                            data-arrow-right-classes="flaticon-next u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right"
                                                            data-pagi-classes="js-pagination text-center u-slick__pagination u-slick__pagination--white position-absolute right-0 bottom-0 left-0 mb-3 mb-0">
                                                            @if (count($hotel->hotel_gallery) > 0)
                                                            @foreach ($hotel->hotel_gallery as $rooms)

                                                            <div class="js-slide">
                                                                <a href="{{ route('singlehotel',$hotel->slug,$hotel->slug) }}"
                                                                    class="d-block gradient-overlay-half-bg-gradient-v5"><img
                                                                        class="img-fluid min-height-230 card-img-top"
                                                                        src="{{ $rooms}}"></a>
                                                            </div>

                                                            @endforeach
                                                            @else
                                                            <div class="js-slide">
                                                                <a href="{{ route('singlehotel',$hotel->slug,$hotel->slug) }}"
                                                                    class="d-block gradient-overlay-half-bg-gradient-v5"><img
                                                                        class="img-fluid min-height-230 card-img-top"
                                                                        src="{{ $hotel->hotel_image}}"></a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xl-5 col-wd-4gdot5 flex-horizontal-center">
                                                <div class="w-100 position-relative m-4 m-md-0">
                                                    <div class="mb-1 pb-1">
                                                        <span
                                                            class="badge badge-orange text-white rounded-xs font-size-13 py-1 p-xl-2">Limited
                                                            Time Offer</span>
                                                        <span class="green-lighter ml-2">
                                                            <small class="fas fa-star font-size-10"></small>
                                                            <small class="fas fa-star font-size-10"></small>
                                                            <small class="fas fa-star font-size-10"></small>
                                                            <small class="fas fa-star font-size-10"></small>
                                                            <small class="fas fa-star font-size-10"></small>
                                                        </span>
                                                    </div>

                                                    <div
                                                        class="position-absolute top-0 right-0 pr-md-3 d-none d-md-block">
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon rounded-circle"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Save for later">
                                                            <span class="flaticon-heart-1 font-size-20"></span>
                                                        </button>
                                                    </div>
                                                    <a href="{{ route('singlehotel',$hotel->slug) }}">
                                                        <span
                                                            class="font-weight-medium font-size-17 text-dark d-flex mb-1">{{$hotel->hotel_name}} </span>
                                                    </a>
                                                    <div class="card-body p-0">
                                                        <a href="{{ $hotel->hotel_map }}"
                                                            class="d-block mb-3">
                                                            <div
                                                                class="d-flex flex-wrap flex-xl-nowrap align-items-center font-size-14 text-gray-1">
                                                                <i
                                                                    class="icon flaticon-placeholder mr-2 font-size-20"></i>
                                                                    {{ \App\Helpers\MyFunctions::getCityName($hotel->loca_city,'city') }},
                                                                    {{ \App\Helpers\MyFunctions::getCountryName($hotel->loca_country,'country')  }}
                                                                <small class="px-1 font-size-15"> - </small>
                                                              <span class="text-primary font-size-14">View on
                                                                    map</span>
                                                            </div>
                                                        </a>
                                                        <ul
                                                            class="list-unstyled mb-2 d-md-flex flex-lg-wrap flex-xl-nowrap">
                                                            @foreach ($hotel->hotel_amenities_title as $hotel_amenities_title)
                                                            <li
                                                                class="border border-dark rounded-xs d-flex align-items-center text-lh-1 py-1 px-2 mr-md-2 mb-2 mb-md-0 mb-lg-2 mb-xl-0">
                                                                <span
                                                                    class="font-weight-normal font-size-14">{{ $hotel_amenities_title }}</span>
                                                            </li>
                                                            @endforeach

                                                        </ul>
                                                        <ul class="list-unstyled d-md-flex">
                                                            <li
                                                                class="border border-green bg-green rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 mb-2 mb-md-0">
                                                                <span
                                                                    class="font-weight-normal font-size-14 text-white">Lowest
                                                                    price includes</span>
                                                            </li>
                                                            <li
                                                                class="border border-green rounded-xs d-flex align-items-center text-lh-1 py-1 px-3 ml-md-n1 mb-2 mb-md-0">
                                                                <span
                                                                    class="font-weight-normal font-size-14 text-green">Free
                                                                    breakfast</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col col-xl-3 col-wd-3gdot5 align-self-center py-4 py-xl-0 border-top border-xl-top-0">
                                                <div
                                                    class="d-xl-flex flex-wrap border-xl-left ml-4 ml-xl-0 pr-xl-3 pr-wd-5 text-xl-right justify-content-xl-end">
                                                    <div class="mb-xl-5 mb-wd-7">
                                                        <div class="mb-0">
                                                            <div class="my-xl-1">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-xl-end mb-2">
                                                                    <span
                                                                        class="badge badge-primary rounded-xs font-size-14 p-2 mr-2 mb-0">
                                                                    {{ count($hotel->Rooms) }}
                                                                    </span>
                                                                    <span
                                                                        class="font-size-17 font-weight-bold text-primary">Avalibal Rooms</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <span class="font-size-14 pl-xl-2">"Great value"
                                                            "Excellent location"</span>
                                                    </div>
                                                    <div class="mb-0">
                                                        <span class="mr-1 font-size-14 text-gray-1">From</span>

                                                        <span class="font-weight-bold">{{  min($hotel->Rooms->pluck('room_price')->all()) }} $</span>

                                                        <span class="font-size-14 text-gray-1"> / night</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                           {{ $hotels->links() }}
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- Slick Tab carousel -->
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@section('js')
    <script>
        // update the guests and rooms value based on the input
        $(document).ready(function() {
            $('#update_guests').click(function(e) {
                e.preventDefault();
                var rooms_number = $('#number_of_rooms').val();
                var rooms_guests = $('#number_of_gusts').val();
                $("#total_guests").html(rooms_number +' Rooms - ' + rooms_guests +' Guests')
            });
        });
    </script>
<script>
    // update the days value based on the input
    $(document).ready(function() {
        $('#update_days').click(function(e) {
            e.preventDefault();
            var rooms_number = $('#days').val();
            $("#total_days").html(rooms_number +' Days')
        });
    });
</script>
<script>
            $(document).ready(function() {
            $('button[data-submit="searchnow"]').click(function(e) {
                e.preventDefault();
                // Get the form ID associated with the clicked button
                var formId = $(this).closest('form').attr('id');
                // Make an Ajax request to the specified route
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/search/' + formId,
                    type: 'POST', // or 'GET' based on your route definition
                    data: $('#' + formId).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                         // Check the status and perform actions accordingly
                        if (response.status == 'success') {
                            // Do something on success, for example, redirect to a new page
                            window.location.href = '/searchdata?searchName='+formId+'&&data=' + encodeURIComponent(JSON.stringify($('#' + formId).serialize()));
                        } else {
                            console.log(response.status);
                        }
                    },
                    error: function(error) {
                        // Handle the error
                        console.error(error);
                    }
                });
            });
        });

</script>

<script>


</script>

@stop
