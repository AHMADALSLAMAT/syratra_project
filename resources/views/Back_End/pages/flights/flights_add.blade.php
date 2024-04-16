@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ADD FLIGHTS</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ADD NEW FLIGHT</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('flights.add_post') }}" method="post" enctype="multipart/form-data"
                    id="flightsadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Add New FLIGHT</h5>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary">Publish Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-8">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Airline NAME</label>
                                                <select name="airline_id" id="airline_id" class="form-control">
                                                    <option value="0">
                                                        <--- Select the related Airline --->
                                                    </option>
                                                    @foreach ($airlines as $airline)
                                                    <option value="{{ $airline->id }}">{{ $airline->airline_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Name</label>
                                                <input type="text" name="flight_name" class="form-control"
                                                    placeholder="Flight Name" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Code</label>
                                                <input type="text" name="flight_sku" class="form-control"
                                                    placeholder="Flight SKU" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flight Type</label>
                                                <select name="flight_type" id="flight_type" class="form-control">
                                                    <option value="economy"> Economy </option>
                                                    <option value="business"> Business </option>
                                                    <option value="first_class"> First Class </option>
                                                    <option value="premium_economy"> Premium Economy </option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Leave Date</label>
                                                <input type="date" name="flight_leave_date" class="form-control"
                                                    placeholder="Flight Leave Date" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Leave Hours</label>
                                                <input type="time" name="flight_leave_hours" class="form-control"
                                                    placeholder="Flight Leave Hours" required>
                                            </div>
                                            <label for="flight_leave_airport">  Select the Leave Airport </label>
                                            <select name="flight_leave_airport" id="flight_leave_airport" class="form-control single-select mt-2">
                                                @foreach ($airports as $airport)
                                                <option value="{{ $airport->code }}">
                                                    {{ $airport->name }}  <span style="font-size: 10px !important">({{ $airport->countryName }})</span>
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Arrive Date</label>
                                                <input type="date" name="flight_arrive_date" class="form-control"
                                                    placeholder="Flight Arrive Date" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Arrive Hours</label>
                                                <input type="time" name="flight_arrive_hours" class="form-control"
                                                    placeholder="Flight Arrive Hours" required>
                                            </div>
                                            <label for="flight_arrive_airport">Select the Arrive Airport </label>
                                            <select name="flight_arrive_airport" id="flight_arrive_airport" class="form-control single-select">
                                                @foreach ($airports as $airport)
                                                <option value="{{ $airport->code }}">
                                                    {{ $airport->name }}
                                                    <span style="font-size: 10px !important">({{ $airport->countryName }})</span>
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="col-12">
                                                <label class="form-label">Flights Stops</label>
                                                <select class="form-select" name="flight_stops" required>
                                                    <option value="0" class="stops">No Stops</option>
                                                    <option value="1" class="stops">There is stops</option>
                                                </select>
                                                <small style="color:red;font-weight:bold"> If there is no stop area then
                                                    the below no need to fill</small>
                                            </div>
                                            <div class="col-12 stops-area" style="display: none">
                                                <label class="form-label">Stops Area</label>
                                                <div class="row gy-3">
                                                    <!-- Group of input fields -->
                                                    <div class="form-group fieldGroup">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="flight_stops_country[]"
                                                                class="form-control"
                                                                placeholder="Flights Stop Country" />
                                                            <input type="text" name="flight_stops_airport[]"
                                                                class="form-control"
                                                                placeholder="Flights Stop Airport" />
                                                            <input type="date" name="flight_stops_date[]"
                                                                class="form-control" placeholder="Flights Stop Date" />
                                                            <input type="time" name="flight_stops_hours[]"
                                                                class="form-control" placeholder="Flights Stop Hours" />
                                                            <span class="input-group-text">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-success addMore"><i
                                                                        class="custicon plus"></i> Add</a>
                                                            </span>
                                                        </div>
                                                        <!-- Replica of input field group HTML -->
                                                        <div class="form-group fieldGroupCopy" style="display: none;">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="flight_stops_country[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Country" />
                                                                <input type="text" name="flight_stops_airport[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Airport" />
                                                                <input type="date" name="flight_stops_date[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Date" />
                                                                <input type="time" name="flight_stops_hours[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Hours" />
                                                                <span class="input-group-text">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-danger remove"><i
                                                                            class="custicon cross"></i> Remove</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Flight Price</label>
                                                <input type="number" required class="form-control" min="0"
                                                    name="flight_price" placeholder="Price">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Offer Price</label>
                                                <input type="number" name="offer_price" class="form-control"
                                                    placeholder="Offer Price">
                                                    <small>this can be empty / the flight price after decound</small>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flight Status</label>
                                                <select class="form-select" name="flight_status" required>
                                                    <option value="1">Published</option>
                                                    <option value="0">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flight Number OF Seats</label>
                                                <input type="number" name="flight_seats" class="form-control"
                                                    placeholder="Flight Number OF Seats" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flight Type</label>
                                                <select class="form-select"
                                                name="flight_return" id="flight_return"
                                                required>
                                                    <option value="onetrip">One Trip</option>
                                                    <option value="returntrip">Return Trip</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="returnGroupForm" style="display: none">
                                                <div class="col-12 col-lg-12">
                                                    <label class="form-label">Flight Return Code</label>
                                                    <input type="text"
                                                    name="return_flight_code"
                                                    class="form-control"
                                                        placeholder="Flight Leave Date" >
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label class="form-label">Flight Return Date</label>
                                                    <input type="date"
                                                    name="return_flight_leave_date"
                                                    class="form-control"
                                                        placeholder="Flight Leave Date" >
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label class="form-label">Flight Return Hours</label>
                                                    <input type="time" name="return_flight_leave_hours" class="form-control"
                                                        placeholder="Flight Leave Hours" >
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label class="form-label">Flight Leave Date</label>
                                                    <input type="date" name="return_flight_arrive_date" class="form-control"
                                                        placeholder="Flight Leave Date" >
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <label class="form-label">Flight Leave Hours</label>
                                                    <input type="time" name="return_flight_arrive_hours" class="form-control"
                                                        placeholder="Flight Leave Hours" >
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label"> Flight return Price</label>
                                                    <input type="number" class="form-control" min="0" name="return_flight_price"
                                                        placeholder="Price" >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label"> Flight Amenities</label>
                                                <div class="form-group fieldGroupAnimate">
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="flight_amenities_icon[]"
                                                            class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" />
                                                        <input type="text" name="flight_amenities_title[]"
                                                            class="form-control" placeholder="Amenities title" />
                                                        <span class="input-group-text">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-success addMoreAnimate"><i
                                                                    class="custicon plus"></i> Add</a>
                                                        </span>
                                                    </div>
                                                    <!-- Replica of input field group HTML -->
                                                    <div class="form-group fieldGroupCopyAnimate"
                                                        style="display: none;">
                                                        <div class="input-group mb-3">
                                                            <input type="file" name="flight_amenities_icon[]"
                                                                class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" />
                                                            <input type="text" name="flight_amenities_title[]"
                                                                class="form-control" placeholder="Amenities title" />
                                                            <span class="input-group-text">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-danger removeAnimate"><i
                                                                        class="custicon cross"></i> Remove</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!--end row-->
</main>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        // Maximum number of groups can be added
        var maxGroup = 10;
        // Add more group of input fields
        $(".addMore").click(function() {
            if ($('body').find('.fieldGroup').length < maxGroup) {
                var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                    '</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });
        // Remove fields group
        $("body").on("click", ".remove", function() {
            $(this).parents(".fieldGroup").remove();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Maximum number of groups can be added
        var maxGroup = 20;
        // Add more group of input fields
        $(".addMoreAnimate").click(function() {
            if ($('body').find('.fieldGroupAnimate').length < maxGroup) {
                var fieldHTML = '<div class="form-group fieldGroupAnimate">' + $(
                        ".fieldGroupCopyAnimate").html() +
                    '</div>';
                $('body').find('.fieldGroupAnimate:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });
        // Remove fields group
        $("body").on("click", ".removeAnimate", function() {
            $(this).parents(".fieldGroupAnimate").remove();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.form-select[name="flight_stops"]').change(function() {
            var stopVar = $(this).val();
            if (stopVar == 1) {
                $('.stops-area').css('display', 'block');
            } else {
                $('.stops-area').css('display', 'none');
            }
        });
    });
</script>
<script>
      $(document).ready(function () {
        getLeaveCountry();
    function getLeaveCountry() {
        $("#leave_country").html("");
        $.ajax({
            url: "get-country",
            type: "GET",
            success: function (data) {
                $.each(data.countries, function (key, value) {
                    $("#leave_country").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.country +
                            "</option>"
                    );
                });
            },
        });
    }
});
</script>
<script>
        $(document).ready(function () {
        getArriveCountry();
    function getArriveCountry() {
        $("#arrive_country").html("");
        $.ajax({
            url: "get-country",
            type: "GET",
            success: function (data) {
                $.each(data.countries, function (key, value) {
                    $("#arrive_country").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.country +
                            "</option>"
                    );
                });
            },
        });
    }
});
</script>
<script>
    $(function () {
        $('#flight_return').change(function(){
           var currentVal = $('#flight_return').val();
            if(currentVal == 'returntrip'){
                $('#returnGroupForm').css('display','block')
            }else{
                $('#returnGroupForm').css('display','none')
            }
        });
    });
</script>
@stop
