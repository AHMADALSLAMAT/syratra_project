<div class="mb-lg-n16">
    <!-- Nav Classic -->
    <ul class="nav tab-nav-rounded flex-nowrap pb-2 pb-md-4 tab-nav" role="tablist">
        <li class="nav-item">
            <a class="nav-link font-weight-medium active pl-md-5 pl-3" id="hoteltab"
                data-toggle="pill" href="#pills-one-example2" role="tab" aria-controls="pills-one-example2"
                aria-selected="true">
                <div
                    class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                    <figure class="ie-height-40 d-md-block mr-md-3">
                        <i class="icon flaticon-hotel font-size-3"></i>
                    </figure>
                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">Hotel</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-medium" id="packagetab" data-toggle="pill"
                href="#pills-two-example2" role="tab" aria-controls="pills-two-example2"
                aria-selected="true">
                <div
                    class="d-flex flex-column flex-md-row  position-relative text-white align-items-center">
                    <figure class="ie-height-40 d-md-block mr-md-3">
                        <i class="icon flaticon-global-1 font-size-3"></i>
                    </figure>
                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">Tours</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-medium" id="flighttab" data-toggle="pill"
                href="#pills-seven-example2" role="tab" aria-controls="pills-seven-example2"
                aria-selected="true">
                <div
                    class="d-flex flex-column flex-md-row  position-relative  text-white align-items-center">
                    <figure class="ie-height-40 d-md-block mr-md-3">
                        <i class="icon flaticon-aeroplane font-size-3"></i>
                    </figure>
                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">Flights</span>
                </div>
            </a>
        </li>
    </ul>
    <!-- End Nav Classic -->
    <div class="tab-content hero-tab-pane">
        <div class="tab-pane fade active show" id="pills-one-example2" role="tabpanel"
            aria-labelledby="hoteltab">
            <!-- Search Jobs Form -->
            <div class="card border-0 tab-shadow">
                <div class="card-body">
                    <form class="js-validate" id="hotel_search" onsubmit="formSubmition()">
                        <div class="row d-block nav-select d-lg-flex mb-lg-3 px-2 px-lg-3 align-items-end">
                            <div class="col-sm-12 col-lg-3dot6 col-xl-3gdot5 mb-4 mb-lg-0">
                                <span
                                    class="d-block text-gray-1 font-weight-normal text-left mb-0">Hotel Name</span>
                                <!-- Select -->
                                <select
                                    class="js-select selectpicker dropdown-select tab-dropdown col-12 pl-0 flaticon-pin-1 d-flex align-items-center text-primary font-weight-semi-bold"
                                    title="Where are you going?" data-style="" data-live-search="true"
                                    data-searchbox-classes="input-group-sm" name="hotel_name">
                                    @foreach ($hotels as $hotel )
                                    <option class="border-bottom border-color-1" value="{{$hotel->slug }}"
                                        data-content='
                                            <span class="d-flex align-items-center">
                                                <span class="font-size-16">{{ $hotel->hotel_name }}</span>
                                            </span>'>
                                            {{ $hotel->hotel_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- End Select -->
                            </div>
                            <div class="col-sm-12 col-lg-3dot7 col-xl-3gdot5 mb-4 mb-lg-0 ">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Check
                                    In - Out</span>
                                <div class="border-bottom border-width-2 border-color-1">
                                    <div id="datepickerWrapperFromOne" class="u-datepicker input-group">
                                        <div class="input-group-prepend">
                                            <span class="d-flex align-items-center mr-2">
                                                <i
                                                    class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                            </span>
                                        </div>
                                        <input name="check_in_out"
                                            class="js-range-datepicker font-size-16 shadow-none font-weight-medium form-control hero-form bg-transparent  border-0"
                                            type="date" data-rp-wrapper="#datepickerWrapperFromOne"
                                            data-rp-type="range" data-rp-date-format="M d - Y"
                                            data-rp-default-date='["Jul-7-2023", "Aug-25-2023"]'>
                                    </div>
                                    <!-- End Datepicker -->
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-xl-3 mb-4 mb-lg-0 dropdown-custom">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Rooms
                                    and Guests</span>
                                <a id="basicDropdownClickInvoker"
                                    class="dropdown-nav-link dropdown-toggle d-flex pt-3 pb-2"
                                    href="javascript:;" role="button" aria-controls="basicDropdownClick"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                    data-unfold-target="#basicDropdownClick"
                                    data-unfold-type="css-animation" data-unfold-duration="300"
                                    data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                    data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    <i
                                        class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-semi-bold"></i>
                                    <span id="total_guests" class="text-black font-size-16 font-weight-semi-bold">1
                                        Rooms - 1 Guests</span>
                                </a>
                                <div id="basicDropdownClick"
                                    class="dropdown-menu dropdown-unfold col-11 m-0"
                                    aria-labelledby="basicDropdownClickInvoker">
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-16 text-secondary font-weight-medium">Rooms</span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="1" id="number_of_rooms" name="number_of_rooms">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-16 text-secondary font-weight-medium">Guests</span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="1" id="number_of_gusts" name="number_of_gusts">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 text-right py-1 pr-5">
                                        <a class="text-primary font-weight-semi-bold font-size-16 update_guests"
                                             id="update_guests" style="cursor: pointer">Done</a>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-sm-12 col-xl-2 align-self-lg-end text-md-right">
                                <button type="button" data-submit="searchnow"
                                    class="btn btn-primary w-100 border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover" ><i
                                        class="flaticon-magnifying-glass font-size-20 mr-2" ></i>Search</button>
                            </div>
                        </div>
                        <!-- End Checkbox -->
                    </form>
                </div>
            </div>
            <!-- End Search Jobs Form -->
        </div>
        <div class="tab-pane fade" id="pills-two-example2" role="tabpanel"
            aria-labelledby="packagetab">
            <!-- Search Jobs Form -->
            <div class="card border-0 tab-shadow">
                <div class="card-body">
                    <form class="js-validate" id="package_search">
                        <div class="row d-block nav-select d-lg-flex mb-lg-3 px-2 px-lg-3 align-items-end">
                            <div class="col-sm-12 col-lg-3dot6 col-xl-3gdot5 mb-4 mb-lg-0 ">
                                <span
                                    class="d-block text-gray-1 font-weight-normal text-left mb-0">Destination
                                    or Country Name</span>
                                <!-- Select -->
                                <select name="package_country"
                                    class="js-select selectpicker dropdown-select tab-dropdown col-12 pl-0 flaticon-pin-1 d-flex align-items-center text-primary font-weight-semi-bold"
                                    title="Where are you going?" data-style="" data-live-search="true"
                                    data-searchbox-classes="input-group-sm">
                                    @foreach ($packages as $package)
                                    <option class="border-bottom border-color-1" value="{{ $package->loca_country }}"
                                        data-content='
                                            <span class="d-flex align-items-center">
                                                <span class="font-size-16">{{ App\Helpers\MyFunctions::getCountryName($package->loca_country,'country') }}</span>
                                            </span>'>
                                            {{ App\Helpers\MyFunctions::getCountryName($package->loca_country,'country') }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- End Select -->
                            </div>
                            <div class="col-sm-12 col-xl-3 mb-4 mb-lg-0 dropdown-custom">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Number Of Days</span>
                                <a id="basicDropdownClickInvoker2"
                                    class="dropdown-nav-link dropdown-toggle d-flex pt-3 pb-2"
                                    href="javascript:;" role="button" aria-controls="basicDropdownClick2"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                    data-unfold-target="#basicDropdownClick2"
                                    data-unfold-type="css-animation" data-unfold-duration="300"
                                    data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                    data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    <i
                                        class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-semi-bold"></i>
                                    <span class="text-black font-size-16 font-weight-semi-bold" id="total_days">1
                                        Days</span>
                                </a>
                                <div id="basicDropdownClick2"
                                    class="dropdown-menu dropdown-unfold col-11 m-0"
                                    aria-labelledby="basicDropdownClickInvoker2">
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-16 text-secondary font-weight-medium">Days</span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="1" id="days" name="days">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 text-right py-1 pr-5">
                                        <a class="text-primary font-weight-semi-bold font-size-16"
                                            href="#" id="update_days">Done</a>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-sm-12 col-xl-2 align-self-lg-end text-md-right">
                                <button type="submit" data-submit="searchnow"
                                    class="btn btn-primary btn-md border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover"><i
                                        class="flaticon-magnifying-glass font-size-20 mr-2"></i>Search</button>
                            </div>
                        </div>
                        <!-- End Checkbox -->
                    </form>
                </div>
            </div>
            <!-- End Search Jobs Form -->
        </div>
        <div class="tab-pane fade" id="pills-seven-example2" role="tabpanel"
            aria-labelledby="flighttab">
            <!-- Search Jobs Form -->
            <div class="card border-0 tab-shadow">
                <div class="card-body">
                    <form class="js-validate" action="{{ route('flight_searchdata') }}" method="POST">
                        @csrf
                        <input type="hidden" name="trip_type" value="rounded">
                        <div class="row nav-select nav-select-1
                                    d-block d-lg-flex mb-lg-2 px-lg-3 px-2 align-items-end">
                            <div class="col-sm-12 col-lg-6 col-xl-2dot3 mb-4 mb-xl-0 ">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">
                                    From where</span>
                                <div class="js-focus-state">
                                    <div class="input-group border-bottom-1">
                                        <!-- Select -->
                                        <select name="flight_leave_country"
                                        class="js-select selectpicker dropdown-select
                                                tab-dropdown col-12 pl-0 flaticon-pin-1 d-flex
                                                align-items-center text-primary
                                                font-weight-semi-bold form-control font-size-lg-12
                                                shadow-none hero-form font-weight-bold
                                                border-0 pl-0 bg-transparent"
                                            title="Where are you going?" data-style="" data-live-search="true"
                                            data-searchbox-classes="input-group-sm">
                                            @foreach ($groupLocation as $location)
                                            <option class="border-bottom border-color-1" value="{{ $location}}"
                                                data-content='
                                                    <span class="d-flex align-items-center">
                                                    <span class="font-size-12">
                                                        {{ App\Models\Airport::where("code",$location)->value("name") }}
                                                        ({{ App\Models\Airport::where("code",$location)->value("countryName") }})
                                                    </span> </span>'>
                                                {{App\Models\Airport::where("code",$location)->value("name")}}
                                                ({{ App\Models\Airport::where("code",$location)->value("countryName") }})
                                            </option>
                                            @endforeach
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-2dot3 mb-4 mb-xl-0 ">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">To
                                    where</span>
                                <div class="js-focus-state">
                                    <div class="input-group border-bottom-1">
                                        <!-- Select -->
                                        <select name="flight_arrive_country"
                                        class="js-select selectpicker dropdown-select
                                                tab-dropdown col-12 pl-0 flaticon-pin-1 d-flex
                                                align-items-center text-primary
                                                font-weight-semi-bold form-control font-size-lg-12
                                                shadow-none hero-form font-weight-bold
                                                border-0 pl-0 bg-transparent"
                                            title="Where are you going?" data-style="" data-live-search="true"
                                            data-searchbox-classes="input-group-sm">
                                            @foreach ($groupLocation as $location)
                                            <option class="border-bottom border-color-1" value="{{ $location}}"
                                                data-content='
                                                    <span class="d-flex align-items-center">
                                                    <span class="font-size-12">
                                                        {{ App\Models\Airport::where("code",$location)->value("name") }}
                                                        ({{ App\Models\Airport::where("code",$location)->value("countryName") }})
                                                    </span> </span>'>
                                                {{App\Models\Airport::where("code",$location)->value("name")}}
                                                ({{ App\Models\Airport::where("code",$location)->value("countryName") }})
                                            </option>
                                            @endforeach
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-sm-12 col-lg-6 col-xl-3 mb-4 mb-xl-0 ">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Depart</span>
                                <div class="border-bottom-1">
                                    <input type="date"
                                        class="form-control font-size-lg-16 shadow-none hero-form font-weight-bold border-0 pl-0 bg-transparent"
                                        name="flight_leave_date" required>
                                    <!-- End Datepicker -->
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-3 mb-4 mb-xl-0 ">
                                <!-- Input -->
                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Return</span>
                                <div class="border-bottom-1">
                                    <input type="date"
                                        class="form-control font-size-lg-16 shadow-none hero-form font-weight-bold border-0 pl-0 bg-transparent"
                                        name="flight_return_date" required>
                                    <!-- End Datepicker -->
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-2dot4 text-left mb-4 mb-xl-0 mt-4">
                                <!-- Input -->
                                <span class="d-block text-gray-1 font-weight-normal mb-0">Travel Type</span>
                                <div class="js-focus-state">
                                    <div class="d-flex border-bottom-1">
                                        <i class="flaticon-plus d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                        <select class="js-select selectpicker dropdown-select">
                                            @foreach ($flight_type as $type)
                                            <option value="{{ $type->flight_type }}" >{{ $type->flight_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-lg-6 col-xl-2dot4 text-left mb-4 mb-xl-0 mt-4 dropdown-custom">
                                <!-- Input -->
                                <span class="d-block text-gray-1 font-weight-normal mb-0">Travelers</span>

                                <a id="basicDropdownClickInvoker"
                                    class="dropdown-nav-link dropdown-toggle d-flex pt-3 pb-2"
                                    href="javascript:;" role="button" aria-controls="basicDropdownClick"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                    data-unfold-target="#basicDropdownClick"
                                    data-unfold-type="css-animation" data-unfold-duration="300"
                                    data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                    data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    <i
                                        class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-semi-bold"></i>
                                    <span id="total_guests" class="text-black font-size-16 font-weight-semi-bold ">1
                                        Adult - 0 Children - 0 Infant</span>
                                </a>
                                <div id="basicDropdownClick"
                                    class="dropdown-menu dropdown-unfold col-11 m-0"
                                    aria-labelledby="basicDropdownClickInvoker">
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-13 text-secondary font-weight-medium">Adults <small>(Age +18)</small></span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="1" id="number_of_adults" name="number_of_adults">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-13 text-secondary font-weight-medium">Children <small>(Age 6-17)</small></span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="0" id="number_of_children" name="number_of_children">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 py-2 px-3 mb-3">
                                        <div
                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                            <span
                                                class="d-block font-size-13 text-secondary font-weight-medium">Infant <small>(Age 0-5)</small></span>
                                            <div class="d-flex">
                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                </a>
                                                <input
                                                    class="js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                    type="text" value="0" id="number_of_infant" name="number_of_infant">
                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle"
                                                    href="javascript:;">
                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100 text-right py-1 pr-5">
                                        <a class="text-primary font-weight-semi-bold font-size-16 update_guests"
                                             id="update_guests" style="cursor: pointer">Done</a>
                                    </div>
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-sm-12 col-xl-2 align-self-lg-end text-md-right"
                            style="margin-left: auto;margin-right:auto">
                                <button type="submit" style="right: 0"
                                    class="btn btn-primary btn-md border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover"><i
                                        class="flaticon-magnifying-glass font-size-20 mr-"></i>Search</button>
                            </div>
                        </div>
                        <!-- End Checkbox -->
                    </form>
                </div>
            </div>
            <!-- End Search Jobs Form -->
        </div>
    </div>
</div>
@section('js')
<script src="{{ asset('front_assest/assets/js/ajaxFunctions/ajaxsearchbar.js') }}"></script>
@stop
