<div id="sidebar" class="collapse navbar-collapse">
    <div class="mb-6 w-100">
        <div class="sidenav border border-color-8 rounded-xs">
            <form class="js-validate" id="hotel_filter" action="{{ route('flightfilter') }}" method="POST" >
                @csrf
            <div id="shopCartAccordion" class="accordion rounded shadow-none">
                <div class="border-0">
                    <div class="card-collapse" id="shopCardHeadingOne">
                        <h3 class="mb-0">
                            <button type="button"
                                class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                data-toggle="collapse" data-target="#shopCardOne"
                                aria-expanded="false" aria-controls="shopCardOne">
                                <span class="row align-items-center">
                                    <span class="col-9">
                                        <span
                                            class="d-block font-size-lg-15 font-size-17 font-weight-bold text-dark">Price
                                            Range ($)</span>
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
                    <div id="shopCardOne" class="collapse show"
                        aria-labelledby="shopCardHeadingOne"
                        data-parent="#shopCartAccordion">
                        <div class="card-body pt-0 px-5 row"
                        style="margin-top: 3px;margin-bottom:3px">
                            @if (!empty($_GET['price']))
                                @php
                                    if(!empty($_GET['price'])){
                                        $price=explode('-',$_GET['price']);
                                    }
                                @endphp
                            @endif
                            <div class="col-12 col-md-6">
                                <input
                                type="number" name="min_price"
                                data-min="{{ App\Helpers\Flight::minPrice() }}"
                                @if (!empty($_GET['price'])) value="{{ $price[0] }}"
                                @else
                                value="{{ App\Helpers\Flight::minPrice() }}"
                                @endif
                                class="text-center min_price form-control form-control-sm"
                                placeholder="$min"
                                style="padding:3px 5px">
                            </div>
                            <div class="col-12 col-md-6">
                                <input
                                type="number"
                                data-max="{{ App\Helpers\Flight::maxPrice() }}"
                                @if (!empty($_GET['price']))
                                value="{{ $price[1] }}"
                                @else
                                value="{{ App\Helpers\Flight::maxPrice() }}"
                                @endif
                                name="max_price"
                                class="text-center max_price form-control form-control-sm"
                                placeholder="$max"
                                style="padding:3px 5px">
                            </div>
                            <div class="col-12 col-md-12" >

                                <button style="width: 100%" type="submit" class="btn btn-dark btn-rounded mt-2">PRICE FILTER</button>
                            </div>
                                <p class="text-center w-100">
                                <small class="text-center">Rang of search between {{ App\Helpers\Flight::minPrice() }} - {{ App\Helpers\Flight::maxPrice() }}
                                </small>
                                </p>
                    </div>
                    </div>
                </div>
            </div>
            </form>
            <form class="js-validate" id="hotel_filter" action="{{ route('flightfilter') }}" method="POST" >
                @csrf
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">Travel Type</span>
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
                            @if (!empty($_GET['travel_type']))
                            @php
                            $travel_type_filter = explode(',',$_GET['travel_type']);
                            @endphp
                            @endif
                            @foreach ($travel_type as $key => $travel )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($travel_type_filter) &&
                                    in_array($travel->travel_type,$travel_type_filter))
                                    checked
                                    @endif
                                    name="travel_type[]"
                                    value="{{ $travel->travel_type }}"
                                    class="custom-control-input hotel-filter"
                                    onchange="this.form.submit();"
                                    id="travel_type{{ $key }}">
                                    <label class="custom-control-label"
                                    for="travel_type{{ $key }}">
                                    {{ $travel->travel_type}}
                                </label>
                            </div>
                            <span>{{ $travel->total }}</span>
                            </div>
                            @endforeach
                            <!-- End Checkboxes -->
                           <!-- End Checkboxes -->
                       </div>
                    </div>
                </div>
            </div>
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">Flights Stops </span>
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
                            @if (!empty($_GET['flight_stops']))
                            @php
                            $filter_flight = explode(',',$_GET['flight_stops']);
                            @endphp
                            @endif
                            @foreach ($flight_stops as $flight )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($filter_flight) && in_array(count($flight->flight_stops_country),$filter_flight))
                                    checked
                                    @endif
                                    name="flight_stops[]"
                                    value="{{ count($flight->flight_stops_country)}}"
                                    class="custom-control-input flight-filter"
                                    onchange="this.form.submit();"
                                    id="flight_stops{{ count($flight->flight_stops_country) }}">
                                    <label class="custom-control-label"
                                    for="flight_stops{{ count($flight->flight_stops_country) }}">
                                    {{ count($flight->flight_stops_country) }} STOP(S)</label>
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">TYPE OF FLIGHT</span>
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
                             @if (!empty($_GET['flight_type']))
                             @php
                             $filter_flight_type = explode(',',$_GET['flight_type']);
                             @endphp
                             @endif
                             @foreach ($flight_type as $key => $type )
                             <div
                                 class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox"
                                     @if (!empty($filter_flight_type) && in_array($type->flight_type,$filter_flight_type))
                                     checked
                                     @endif
                                     name="flight_type[]"
                                     value="{{ $type->flight_type }}"
                                     class="custom-control-input hotel-filter"
                                     onchange="this.form.submit();"
                                     id="flight_type{{ $key }}">
                                     <label class="custom-control-label"
                                     for="flight_type{{ $key }}">{{ $type->flight_type }}</label>
                                 </div>

                             </div>
                             @endforeach
                             <!-- End Checkboxes -->
                            <!-- End Checkboxes -->
                        </div>
                    </div>
                </div>
            </div>

            <div id="propertyCategoryAccordiontraveltype"
            class="accordion rounded-0 shadow-none border-top">
            <div class="border-0">
                <div class="card-collapse" id="propertyCategoryHeadingOnepropertyCategoryAccordiontraveltype">
                    <h3 class="mb-0">
                        <button type="button"
                            class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                            data-toggle="collapse" data-target="#propertyCategoryOnepropertyCategoryAccordiontraveltype"
                            aria-expanded="false" aria-controls="propertyCategoryOnepropertyCategoryAccordiontraveltype">
                            <span class="row align-items-center">
                                <span class="col-9">
                                    <span
                                        class="font-weight-bold font-size-17 text-dark mb-3">FLIGHT COUNTRY</span>
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
                <div id="propertyCategoryOnepropertyCategoryAccordiontraveltype" class="collapse show"
                    aria-labelledby="propertyCategoryHeadingOnepropertyCategoryAccordiontraveltype"
                    data-parent="#propertyCategoryAccordion">
                    <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <!-- Checkboxes -->
                        @if (!empty($_GET['flight_leave_country']))
                        @php
                        $filter_flight_location = explode(',',$_GET['flight_leave_country']);
                        @endphp
                        @endif
                        @foreach ($flight_leave_country as $key => $location_leave )
                        <div
                            class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                @if (!empty($filter_flight_location) &&
                                in_array($location_leave->flight_leave_country,$filter_flight_location))
                                checked
                                @endif
                                name="flight_leave_country[]"
                                value="{{ $location_leave->flight_leave_country }}"
                                class="custom-control-input hotel-filter"
                                onchange="this.form.submit();"
                                id="flight_leave_country{{ $key }}">
                                <label class="custom-control-label"
                                for="flight_leave_country{{ $key }}">
                                {{ $location_leave->flight_leave_country}}
                            </label>
                        </div>
                        <span>{{ $location_leave->total }}</span>

                        </div>
                        @endforeach
                        <!-- End Checkboxes -->
                       <!-- End Checkboxes -->
                   </div>
                </div>
            </div>
        </div>
            <div id="propertyCategoryAccordionarrive"
            class="accordion rounded-0 shadow-none border-top">
            <div class="border-0">
                <div class="card-collapse" id="propertyCategoryHeadingOnearrive">
                    <h3 class="mb-0">
                        <button type="button"
                            class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                            data-toggle="collapse" data-target="#propertyCategoryOnearrive"
                            aria-expanded="false" aria-controls="propertyCategoryOnearrive">
                            <span class="row align-items-center">
                                <span class="col-9">
                                    <span
                                        class="font-weight-bold font-size-17 text-dark mb-3">FLIGHT AIRPORT</span>
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
                <div id="propertyCategoryOnearrive" class="collapse show"
                    aria-labelledby="propertyCategoryHeadingOnearrive"
                    data-parent="#propertyCategoryAccordionarrive">
                    <div class="card-body pt-0 mt-1 px-5 pb-4">
                        <!-- Checkboxes -->
                        @if (!empty($_GET['flight_arrive_airport']))
                        @php
                        $filter_flight_arrive = explode(',',$_GET['flight_arrive_airport']);
                        @endphp
                        @endif
                        @foreach ($flight_arrive_country as $key => $location_arrive )
                        <div
                            class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                @if (!empty($filter_flight_arrive) && in_array($location_arrive->flight_arrive_airport,$filter_flight_arrive))
                                checked
                                @endif
                                name="flight_arrive_airport[]"
                                value="{{ $location_arrive->flight_arrive_airport }}"
                                class="custom-control-input hotel-filter"
                                onchange="this.form.submit();"
                                id="flight_arrive_airport{{ $key }}">
                                <label class="custom-control-label"
                                for="flight_arrive_airport{{ $key }}">
                                {{ \App\Helpers\MyFunctions::getAirportData($location_arrive->flight_arrive_airport,'name')  }} </label>
                            </div>
                            <span>{{ $location_arrive->total }}</span>

                        </div>
                        @endforeach
                        <!-- End Checkboxes -->
                       <!-- End Checkboxes -->
                   </div>
                </div>
            </div>
        </form>
        </div>
            <!-- End Accordion -->
        </div>
    </div>
</div>

