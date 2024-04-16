@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">EDIT FLIGHT</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT FLIGHT</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('flights.update',$flight->id) }}" method="post" enctype="multipart/form-data"
                    id="flightsadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit Flight</h5>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary">Upldated Now</button>
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
                                                    <option value="{{ $airline->id }}" @if($flight->airline_id ==
                                                        $airline->id) selected @endif>
                                                        {{ $airline->airline_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Name</label>
                                                <input type="text" name="flight_name" class="form-control"
                                                    placeholder="Flight Name" required
                                                    value="{{ $flight->flight_name }}">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight SKU</label>
                                                <input type="text" name="flight_sku" class="form-control"
                                                    placeholder="Flight SKU" required value="{{ $flight->flight_sku }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flight Type</label>
                                                <select name="flight_type" id="flight_type" class="form-control">
                                                    <option value="economy" @if ($flight->flight_type =='economy')
                                                        selected @endif>
                                                        Economy </option>
                                                    <option value="business" @if ($flight->flight_type =='business')
                                                        selected @endif>
                                                        Business </option>
                                                    <option value="first_class"
                                                    @if ($flight->flight_type =='first_class') selected @endif>
                                                        First Class </option>
                                                    <option value="premium_economy" @if ($flight->flight_type =='premium_economy') selected @endif>
                                                        Premium Economy </option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Leave Date</label>
                                                <input type="date" name="flight_leave_date" class="form-control"
                                                    placeholder="Flight Leave Date" required
                                                    value="{{ $flight->flight_leave_date }}">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Leave Hours</label>
                                                <input type="time" name="flight_leave_hours" class="form-control"
                                                    placeholder="Flight Leave Hours" required
                                                    value="{{ $flight->flight_leave_hours }}">
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label for="flight_leave_airport">Select the Leave Airport </label>
                                                <select name="flight_leave_airport" id="flight_leave_airport" class="form-control single-select">
                                                    @foreach ($airports as $airport)
                                                    <option value="{{ $airport->code }}"
                                                        @if ($airport->code == $flight->flight_leave_airport)
                                                        selected @endif
                                                        >
                                                        {{ $airport->name }}
                                                        <span style="font-size: 10px !important">({{ $airport->countryName }})</span>
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Arrive Date</label>
                                                <input type="date" name="flight_arrive_date" class="form-control"
                                                    placeholder="Flight Arrive Date" required
                                                    value="{{ $flight->flight_arrive_date }}">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Flight Arrive Hours</label>
                                                <input type="time" name="flight_arrive_hours" class="form-control"
                                                    placeholder="Flight Arrive Hours" required
                                                    value="{{ $flight->flight_arrive_hours }}">
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label for="flight_arrive_airport">Select the Arrive Airport </label>
                                                <select name="flight_arrive_airport" id="flight_arrive_airport" class="form-control single-select">
                                                    @foreach ($airports as $airport)
                                                    <option value="{{ $airport->code }}"
                                                        @if ($airport->code == $flight->flight_arrive_airport)
                                                        selected @endif >
                                                        {{ $airport->name }}
                                                        <span style="font-size: 10px !important">({{ $airport->countryName }})</span>
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Flights Stops</label>
                                                <select class="form-select" name="flight_stops" required>
                                                    <option value="0"
                                                    @if ($flight->flight_stops == 0) selected @endif
                                                    class="stops">No Stops</option>
                                                    <option value="1" class="stops"
                                                    @if ($flight->flight_stops == 1) selected @endif>There is stops</option>
                                                </select>
                                                <small style="color:red;font-weight:bold"> If there is no stop area then
                                                    the below no need to fill</small>
                                            </div>
                                            <div class="col-12 stops-area"
                                            @if($flight->flight_stops == 0 )
                                            style="display: none;" @else
                                            style="display: block;" @endif>
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
                                                        @foreach ($flight->flight_stops_country as $key => $item)
                                                        @if ($item != null)
                                                        <div class="form-group fieldGroupCopyEdit">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="old_flight_stops_country[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Country"
                                                                    value="{{$item}}" />
                                                                <input type="text" name="old_flight_stops_airport[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Airport"
                                                                    value="{{ $flight->flight_stops_airport[$key]}}" />
                                                                <input type="date" name="old_flight_stops_date[]"
                                                                    class="form-control" placeholder="Flights Stop Date"
                                                                    value="{{ $flight->flight_stops_date[$key]}}" />
                                                                <input type="time" name="old_flight_stops_hours[]"
                                                                    class="form-control"
                                                                    placeholder="Flights Stop Hours"
                                                                    value="{{ $flight->flight_stops_hours[$key]}}" />
                                                                <span class="input-group-text">
                                                                    <a href="javascript:void(0)"
                                                                    class="btn btn-danger removeEdit"><i
                                                                    class="custicon cross"></i> Remove</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
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
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" min="0" name="flight_price"
                                                placeholder="Price" value="{{ $flight->flight_price }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Offer Price</label>
                                            <input type="number" name="offer_price" class="form-control"
                                                placeholder="Flight offer price" value="{{ $flight->offer_price }}">
                                                <small>this can be empty / the room price after decound</small>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="flight_status">
                                                <option @if ($flight->flight_status == 1) selected @endif
                                                    value="1">Published</option>
                                                <option @if ($flight->flight_status == 0) selected @endif
                                                    value="0">Draft</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Flight Number OF Seats</label>
                                            <input type="number" name="flight_seats" class="form-control"
                                                placeholder="Flight Number OF Seats" value="{{ $flight->flights_seats }}" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Flight Type</label>
                                            <input type="text" disabled name="flight_seats" class="form-control"
                                                placeholder="Flight Number OF Seats" value="@if ($flight->return_flight == 0) One Trip @else Return Trip @endif" required>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label"> flight Amenities</label>
                                            <div class="form-group fieldGroupAnimate">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" placeholder="Amenities icon"
                                                        style="font-size: 10px;
                                                        align-self: center;" name="flight_amenities_icon[]" />
                                                    <input type="text" class="form-control"
                                                        placeholder="Amenities title" name="flight_amenities_title[]" />
                                                    <span class="input-group-text">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-success addMoreAnimate"><i
                                                                class="custicon plus"></i> Add</a>
                                                    </span>
                                                </div>
                                                @foreach ($flight->flight_amenities_title as $key => $item)
                                                @if ($item != null)
                                                <div class="form-group fieldGroupCopyAnimateEdit">
                                                    <img src="{{ asset($flight->flight_amenities_icon[$key]) }}"
                                                        width="100" class="img-fluid mb-2" alt="Old Image"><br>
                                                    <input type="hidden" name="old_flight_amenities_icon[]"
                                                        value="{{ $flight->flight_amenities_icon[$key] }}" />
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="old_flight_amenities_icon[]"
                                                            class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" />
                                                        <input type="text" name="old_flight_amenities_title[]"
                                                            class="form-control" placeholder="Amenities title"
                                                            value="{{ $item }}" />
                                                        <span class="input-group-text">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger removeAnimateEdit"><i
                                                                    class="custicon cross"></i> Remove</a>
                                                        </span>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!-- Replica of input field group HTML -->
                                                <div class="form-group fieldGroupCopyAnimate" style="display: none;">
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
        $("body").on("click", ".removeEdit", function() {
            $(this).parents(".fieldGroupCopyEdit").remove();
        });
    });
    $(document).ready(function() {
        $("body").on("click", ".removeAnimateEdit", function() {
            $(this).parents(".fieldGroupCopyAnimateEdit").remove();
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
     var leaveContry = "{{ $flight->flight_leave_country }}"
      $.ajax({
          url: "/dashboard/get-country/",
          type: "GET",
          success: function (data) {
              $.each(data.countries, function (key, value) {
                  $("#leave_country").append(

                      '<option'+ (value.id == leaveContry ? ' selected ' : '') + ' value="' +
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
      var arriveContry = "{{ $flight->flight_arrive_country }}"
      $.ajax({
          url: "/dashboard/get-country/",
          type: "GET",
          success: function (data) {
              $.each(data.countries, function (key, value) {
                  $("#arrive_country").append(
                    '<option'+ (value.id == arriveContry ? ' selected ' : '') + ' value="' +
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

@stop
