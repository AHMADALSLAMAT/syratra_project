<style>
    .filter-option-inner-inner{
        font-size: 13px;
        line-height: 1
    }
    .nav-select .bootstrap-select button{
        padding-bottom: 10px
    }
    .green-color{
        background: #119992
    }
    .dropdown-menu .inner.show{
        max-height: 300px !important;
    }
</style>
<div class="tab-pane fade active show" id="pills-one-example2" role="tabpanel" aria-labelledby="pills-one-example2-tab">
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
                     <!-- Select -->
                     <div class="input-group border-bottom-1">
                     <select name="flight_leave_country"
                     class="js-select selectpicker dropdown-select
                     tab-dropdown col-12 pl-0 flaticon-pin-1 d-flex
                     align-items-center text-primary
                     font-weight-semi-bold form-control font-size-lg-12
                     shadow-none hero-form font-weight-bold
                     border-0 pl-0 bg-transparent flight_leave_country" id="flight_leave_country"
                         title="Where are you going?" data-style="" data-live-search="true"
                         data-searchbox-classes="input-group-sm">
                         @foreach ($airports as $location)
                         <option class="border-bottom border-color-1" value="{{ $location->code}}"
                             data-content='
                                 <span class="d-flex align-items-center">
                                 <span class="font-size-12">
                                     {{ $location->name }}
                                     ({{  $location->countryName}})
                                 </span> </span>'>
                                 {{ $location->name }}
                                 ({{  $location->countryName}})
                         </option>
                         @endforeach
                     </select>
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
                                border-0 pl-0 bg-transparent arrivecountry" id="arrivecountry"
                            title="Where are you going?" data-style="" data-live-search="true"
                            data-searchbox-classes="input-group-sm">
                            @foreach ($airports as $location)
                            <option class="border-bottom border-color-1" value="{{ $location->code}}"
                                data-content='
                                    <span class="d-flex align-items-center">
                                    <span class="font-size-12">
                                        {{ $location->name }}
                                        ({{  $location->countryName}})
                                    </span> </span>'>
                                    {{ $location->name }}
                                    ({{  $location->countryName}})
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
            <div class="col-sm-12 col-lg col-xl-1dot8" style="margin-left: auto;margin-right:auto">
                <button type="submit" style="right: 0"
                    class="btn green-color width-lg-200 text-white border-radius-2 font-weight-bold btn-md mb-xl-0 mb-lg-1 transition-3d-hover w-100 w-md-auto"><i
                        class="flaticon-magnifying-glass mr-2"></i>Search</button>
            </div>
        </div>
        <!-- End Checkbox -->
    </form>
</div>

@section('js')
<script>
        // update the guests and rooms value based on the input
        $(document).ready(function() {
            $('#update_guests').click(function(e) {
                e.preventDefault();
                var adults_number = $('#number_of_adults').val();
                var children_number = $('#number_of_children').val();
                var infant_number = $('#number_of_infant').val();
                $("#total_guests").html(adults_number +' Adults - ' + children_number +' Children - ' + infant_number +' Infant')
            });
        });
</script>

{{--<script src="{{ asset('front_assest/assets/js/ajaxFunctions/ajaxAPI.js') }}"></script>--}}

@endsection
