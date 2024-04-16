<div id="sidebar" class="collapse navbar-collapse">
    <div class="mb-6 w-100">
        <div class="pb-4 mb-2">
            <div class="sidebar border border-color-1 rounded-xs">
                <form class="js-validate" id="hotel_search" onsubmit="formSubmition()">
                <div class="p-4 mb-1">
                    <!-- Input -->
                    <span
                        class="d-block text-gray-1  font-weight-normal mb-0 text-left">Destination
                        or Hotel Name</span>
                    <div class="mb-4">
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
                    </div>
                    <!-- End Input -->
                    <!-- Input -->
                    <span
                        class="d-block text-gray-1 font-weight-normal mb-0 text-left">Check
                        In - Out</span>
                    <div class="mb-4">
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
                                    data-rp-default-date='["Jul-7-2023","Aug-25-2023"]'>
                            </div>
                            <!-- End Datepicker -->
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <span
                        class="d-block text-gray-1 font-weight-normal mb-0 text-left">Rooms
                        and Guests</span>
                    <div class="mb-4 position-relative">
                        <div class="border-bottom border-width-2 border-color-1">
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
                    </div>
                    <!-- End Input -->

                    <div class="text-center">
                        <button type="button" data-submit="searchnow"
                        class="btn btn-primary w-100 border-radius-3 mb-xl-0 mb-lg-1 transition-3d-hover" ><i
                            class="flaticon-magnifying-glass font-size-20 mr-2" ></i>Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <form class="js-validate" id="hotel_filter" action="{{ route('hotelfilter') }}" method="POST" >
            @csrf
        <div class="sidenav border border-color-8 rounded-xs">
            <div id="shopCategoryAccordion"
                class="accordion rounded-0 shadow-none border-top">
                <div class="border-0">
                    <div class="card-collapse" id="shopCategoryHeadingOne">
                        <h3 class="mb-0">
                            <button type="button"
                                class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                data-toggle="collapse" data-target="#shopCategoryOne"
                                aria-expanded="false" aria-controls="shopCategoryOne">
                                <span class="row align-items-center">
                                    <span class="col-9">
                                        <span
                                            class="font-weight-bold font-size-17 text-dark mb-3">HOTELS NAME</span>
                                    </span>
                                    <span class="col-3 text-right">
                                        <span class="card-btn-arrow">
                                            <span class="fas fa-chevron-down small"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                        </h3>
                    </div>
                    <div id="shopCategoryOne" class="collapse show"
                        aria-labelledby="shopCategoryHeadingOne"
                        data-parent="#shopCategoryAccordion">
                        <div class="card-body pt-0 mt-1 px-5 pb-4">
                            <!-- Checkboxes -->
                            @if (!empty($_GET['hotel_name']))
                            @php
                            $filter_hotel = explode(',',$_GET['hotel_name']);
                            @endphp
                            @endif
                            @foreach ($hotels_names as $hotel )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($filter_hotel) && in_array($hotel->slug,$filter_hotel))
                                    checked
                                    @endif
                                    name="hotel_name[]"
                                    value="{{ $hotel->slug }}"
                                    class="custom-control-input hotel-filter"
                                    onchange="this.form.submit();"
                                    id="hotels_name{{ $hotel->id }}">
                                    <label class="custom-control-label"
                                    for="hotels_name{{ $hotel->id }}">{{ $hotel->hotel_name }}</label>
                                </div>
                            </div>
                            @endforeach
                            <!-- End Checkboxes -->
                        </div>
                    </div>
                </div>
            </div>
            <div id="facilityCategoryAccordion"
                class="accordion rounded-0 shadow-none border-top">
                <div class="border-0">
                    <div class="card-collapse" id="facilityCategoryHeadingOne">
                        <h3 class="mb-0">
                            <button type="button"
                                class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                data-toggle="collapse" data-target="#facilityCategoryOne"
                                aria-expanded="false" aria-controls="facilityCategoryOne">
                                <span class="row align-items-center">
                                    <span class="col-9">
                                        <span
                                            class="font-weight-bold font-size-17 text-dark mb-3">TYPE OF HOTEL</span>
                                    </span>
                                    <span class="col-3 text-right">
                                        <span class="card-btn-arrow">
                                            <span class="fas fa-chevron-down small"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                        </h3>
                    </div>
                    <div id="facilityCategoryOne" class="collapse show"
                        aria-labelledby="facilityCategoryHeadingOne"
                        data-parent="#facilityCategoryAccordion">
                        <div class="card-body pt-0 mt-1 px-5 pb-4">
                             <!-- Checkboxes -->
                             @if (!empty($_GET['hotel_type']))
                             @php
                             $filter_hotel_type = explode(',',$_GET['hotel_type']);
                             @endphp
                             @endif
                             @foreach ($hotelstype as $key => $type )
                             <div
                                 class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox"
                                     @if (!empty($filter_hotel_type) && in_array($type->hotel_type,$filter_hotel_type))
                                     checked
                                     @endif
                                     name="hotel_type[]"
                                     value="{{ $type->hotel_type }}"
                                     class="custom-control-input hotel-filter"
                                     onchange="this.form.submit();"
                                     id="hotels_type{{ $key }}">
                                     <label class="custom-control-label"
                                     for="hotels_type{{ $key }}">{{ $type->hotel_type }}</label>
                                 </div>
                                 <span>{{ $type->total }}</span>
                             </div>
                             @endforeach
                             <!-- End Checkboxes -->
                            <!-- End Checkboxes -->
                        </div>
                    </div>
                </div>
            </div>
            <div id="propertyCategoryAccordion"
                class="accordion rounded-0 shadow-none border-top">
                <div class="border-0">
                    <div class="card-collapse" id="propertyCategoryHeadingOne">
                        <h3 class="mb-0">
                            <button type="button"
                                class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                data-toggle="collapse" data-target="#propertyCategoryOne"
                                aria-expanded="false" aria-controls="propertyCategoryOne">
                                <span class="row align-items-center">
                                    <span class="col-9">
                                        <span
                                            class="font-weight-bold font-size-17 text-dark mb-3">HOTEL LOCATION</span>
                                    </span>
                                    <span class="col-3 text-right">
                                        <span class="card-btn-arrow">
                                            <span class="fas fa-chevron-down small"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                        </h3>
                    </div>
                    <div id="propertyCategoryOne" class="collapse show"
                        aria-labelledby="propertyCategoryHeadingOne"
                        data-parent="#propertyCategoryAccordion">
                        <div class="card-body pt-0 mt-1 px-5 pb-4">
                            <!-- Checkboxes -->
                            @if (!empty($_GET['hotel_location']))
                            @php
                            $filter_hotel_location = explode(',',$_GET['hotel_location']);
                            @endphp
                            @endif
                            @foreach ($hotelslocation as $key => $location )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($filter_hotel_location) && in_array($location->loca_country,$filter_hotel_location))
                                    checked
                                    @endif
                                    name="hotel_location[]"
                                    value="{{ $location->loca_country }}"
                                    class="custom-control-input hotel-filter"
                                    onchange="this.form.submit();"
                                    id="hotels_location{{ $key }}">
                                    <label class="custom-control-label"
                                    for="hotels_location{{ $key }}">
                                    {{ \App\Helpers\MyFunctions::getCountryName($location->loca_country,'country')  }}</label>
                                </div>
                                <span>{{ $location->total }}</span>
                            </div>
                            @endforeach
                            <!-- End Checkboxes -->
                           <!-- End Checkboxes -->
                       </div>
                    </div>
                </div>
            </div>
            <!-- End Accordion -->
        </div>
        </form>
    </div>
</div>

