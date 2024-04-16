@extends('Front_End.layout.main_desgin')
@section('title','Flights Booking')
@section('content')
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" class="bg-gray space-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        @include('Front_End.pages.booking.user_data')
                    </div>
                    <!-- LEFT SIDEBAR -->
                    <div class="col-lg-4 col-xl-3">
                        <div class="shadow-soft bg-white rounded-sm">
                            <div class="pt-5 pb-3 px-5 border-bottom">
                                <a href="#" class="d-block mb-3">
                                    <img class="img-fluid rounded-xs" src="{{ asset($dataFlight['departure_flight']['airlines']['airline_logo']) }}"
                                        alt="Image-Description">
                                </a>
                                <a href="#" class="text-dark font-weight-bold mb-1">{{ $dataFlight['departure_flight']['airlines']['airline_name'] }}</a>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="flex-horizontal-center text-gray-1">
                                    @if ($flight_type == 'oneway')
                                        Oneway Flight
                                    @else
                                        Return Flight
                                    @endif
                                    </div>
                                    <div class="text-secondary">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal{{ $dataFlight['departure_flight']['id'] }}"
                                        class="text-underline text-black">
                                        Info <i class="fa fa-question-circle"
                                        title="view the flight details"
                                        aria-hidden="true"></i> </a>
                                    </div>
                                </div>
                                 <!-- Leave Flight Data -->
                                <div class="flex-content-center flex-column mb-1">
                                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                        {{App\Helpers\Flight::calculateHoursDifference(
                                            $dataFlight['departure_flight']['flight_leave_date'],$dataFlight['departure_flight']['flight_leave_hours'],
                                            $dataFlight['departure_flight']['flight_arrive_date'],$dataFlight['departure_flight']['flight_arrive_hours']) }}

                                    </h6>
                                    <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                    <div class="font-size-14 text-gray-1">
                                       @if($dataFlight['departure_flight']['flight_stops'] != 0)
                                       {{ count($dataFlight['departure_flight']['flight_stops_country']) }} Stops
                                       @else
                                       No Stops
                                       @endif
                                    </div>
                                </div>
                                <div class="flex-horizontal-center justify-content-between">
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                {{ $dataFlight['departure_flight']['departure_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['departure_flight']['departure_airport']['countryName'] }})
                                                </small>
                                            </h6>

                                        </div>
                                    </div>
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i
                                                class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                {{ $dataFlight['departure_flight']['arrival_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['departure_flight']['arrival_airport']['countryName'] }})
                                                </small>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Return Flight Data -->
                                <div class="flex-content-center flex-column mb-1 mt-3">
                                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                        {{App\Helpers\Flight::calculateHoursDifference(
                                            $dataFlight['return_flight']['flight_leave_date'],$dataFlight['return_flight']['flight_leave_hours'],
                                            $dataFlight['return_flight']['flight_arrive_date'],$dataFlight['return_flight']['flight_arrive_hours']) }}

                                    </h6>
                                    <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                    <div class="font-size-14 text-gray-1">
                                       @if($dataFlight['return_flight']['flight_stops'] != 0)
                                       {{ count($dataFlight['return_flight']['flight_stops_country']) }} Stops
                                       @else
                                       No Stops
                                       @endif
                                    </div>
                                </div>
                                <div class="flex-horizontal-center justify-content-between">
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">{{ $dataFlight['return_flight']['departure_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['return_flight']['departure_airport']['countryName'] }})
                                                </small>
                                            </h6>

                                        </div>
                                    </div>
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i
                                                class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                                {{ $dataFlight['return_flight']['arrival_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['return_flight']['arrival_airport']['countryName'] }})
                                                </small>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion">
                                <!-- Card -->
                                <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                                    <div class="card-header card-collapse bg-transparent border-0"
                                        id="basicsHeadingOne">
                                        <h5 class="mb-0">
                                            <button type="button"
                                                class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                                data-toggle="collapse" data-target="#basicsCollapseOne"
                                                aria-expanded="true" aria-controls="basicsCollapseOne">
                                                Booking Detail

                                                <span class="card-btn-arrow font-size-14 text-dark">
                                                    <i class="fas fa-chevron-down"></i>
                                                </span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseOne" class="collapse show" aria-labelledby="basicsHeadingOne"
                                        data-parent="#basicsAccordion">
                                        <div class="card-body px-4 pt-0">
                                            <!-- Fact List -->
                                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Airline</span>
                                                    <span class="text-secondary">{{  $dataFlight['departure_flight']['airlines']['airline_name'] }}</span>
                                                </li>

                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Flight type</span>
                                                    <span class="text-secondary">{{  $dataFlight['departure_flight']['flight_type'] }}</span>
                                                </li>
                                            </ul>
                                            <!-- End Fact List -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->

                                <!-- Card -->
                                <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                                    <div class="card-header card-collapse bg-transparent border-0"
                                        id="basicsHeadingFour">
                                        <h5 class="mb-0">
                                            <button type="button"
                                                class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                                data-toggle="collapse" data-target="#basicsCollapseFour"
                                                aria-expanded="false" aria-controls="basicsCollapseFour">
                                                Payment

                                                <span class="card-btn-arrow font-size-14 text-dark">
                                                    <i class="fas fa-chevron-down"></i>
                                                </span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseFour" class="collapse show"
                                        aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion">
                                        <div class="card-body px-4 pt-0">
                                            <!-- Fact List -->
                                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Subtotal</span>
                                                    <span class="text-secondary">
                                                        {{ $dataFlight['departure_flight']['flight_price'] +
                                                        $dataFlight['return_flight']['flight_price'] }} $
                                                    </span>
                                                </li>
                                                <li class="d-flex justify-content-between py-2 ticketplan">
                                                    <span class="font-weight-medium">Ticket Plan</span>
                                                    <span class="text-secondary">$ 0,00</span>
                                                </li>
                                                <li class="d-flex justify-content-between py-2 ticket">
                                                    <span class="font-weight-medium">Extra baggages</span>
                                                    <span class="text-secondary">$ 0,00</span>
                                                </li>
                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Tax</span>
                                                    <span class="text-secondary">0 %</span>
                                                </li>
                                                <li
                                                    class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                                    <span class="font-weight-bold">Pay Amount</span>
                                                    <span class="text-secondary">{{
                                                    $dataFlight['departure_flight']['flight_price'] +
                                                    $dataFlight['return_flight']['flight_price'] }} $</span>
                                                </li>
                                            </ul>
                                            <!-- End Fact List -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Basics Accordion -->
                        </div>
                    </div>
                    <!-- END LEFT SIDEBAR -->
                </div>
            </div>
        </main>
        <!-- Modal -->
    <div class="modal fade bd-example-modal-lg"
        id="exampleModal{{ $dataFlight['departure_flight']['id'] }}"
        tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel{{ $dataFlight['departure_flight']['id'] }}"
        aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel{{ $dataFlight['departure_flight']['id'] }}">FLIGHT DETAILS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Header -->
          <header class="card-header bg-light py-4 px-4">
              <div class="col-md-auto mb-4 mb-md-0">
                  <div
                      class="d-block d-lg-flex flex-horizontal-center">
                      <img class="img-fluid mr-3 mb-3 mb-lg-0"
                          src="{{ asset($dataFlight['departure_flight']['airlines']['airline_logo']) }}"
                          alt="Image-Description" width="300">
                      <div class="font-size-14">{{$dataFlight['departure_flight']['flight_name']}} | {{ $dataFlight['departure_flight']['flight_sku'] }}</div>
                  </div>
              </div>
            <div class="row align-items-center text-center">
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                        <div class="mr-lg-3 mb-1 mb-lg-0">
                            <i
                                class="flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lg-left">
                            <h6
                                class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ $dataFlight['departure_flight']['flight_leave_hours'] }}</h6>
                            <div class="font-size-14 text-gray-5">
                                {{ $dataFlight['departure_flight']['flight_leave_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $dataFlight['departure_flight']['departure_airport']['name'] }}
                                    <small style="font-size: 10px">({{ $dataFlight['departure_flight']['departure_airport']['countryName'] }})
                                    </small>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center flex-column">
                        <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                            {{App\Helpers\Flight::calculateHoursDifference(
                                $dataFlight['departure_flight']['flight_leave_date'],$dataFlight['departure_flight']['flight_leave_hours'],
                                $dataFlight['departure_flight']['flight_arrive_date'],$dataFlight['departure_flight']['flight_arrive_hours']) }}
                        </h6>
                        <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                        <div class="font-size-14 text-gray-1">
                           @if($dataFlight['return_flight']['flight_stops'] != 0)
                           {{ count($dataFlight['return_flight']['flight_stops_country']) }} Stops
                           @else
                           No Stops
                           @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                        <div class="mr-lg-3 mb-1 mb-lg-0">
                            <i
                                class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lg-left">
                            <h6
                                class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ $dataFlight['departure_flight']['flight_arrive_hours'] }}</h6>
                            <div class="font-size-14 text-gray-5">
                                {{ $dataFlight['departure_flight']['flight_arrive_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $dataFlight['departure_flight']['arrival_airport']['name'] }}
                                    <small style="font-size: 10px">({{ $dataFlight['departure_flight']['arrival_airport']['countryName'] }})
                                    </small>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center text-center">
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                        <div class="mr-lg-3 mb-1 mb-lg-0">
                            <i
                                class="flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lg-left">
                            <h6
                                class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ $dataFlight['return_flight']['flight_leave_hours'] }}</h6>
                            <div class="font-size-14 text-gray-5">
                                {{ $dataFlight['return_flight']['flight_leave_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $dataFlight['return_flight']['departure_airport']['name'] }}
                                    <small style="font-size: 10px">({{ $dataFlight['return_flight']['departure_airport']['countryName'] }})
                                    </small>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center flex-column">
                        <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                           {{App\Helpers\Flight::calculateHoursDifference(
                            $dataFlight['return_flight']['flight_leave_date'],$dataFlight['return_flight']['flight_leave_hours'],
                            $dataFlight['return_flight']['flight_arrive_date'],$dataFlight['return_flight']['flight_arrive_hours']) }}
                        </h6>
                        <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                        <div class="font-size-14 text-gray-1">
                           @if($dataFlight['return_flight']['flight_stops'] != 0)
                           {{ count($dataFlight['return_flight']['flight_stops_country']) }} Stops
                           @else
                           No Stops
                           @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center align-items-start d-block d-lg-flex">
                        <div class="mr-lg-3 mb-1 mb-lg-0">
                            <i
                                class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lg-left">
                            <h6
                                class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ $dataFlight['return_flight']['flight_arrive_hours'] }}</h6>
                            <div class="font-size-14 text-gray-5">
                                {{ $dataFlight['return_flight']['flight_arrive_date'] }}</div>
                                <span style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                    {{ $dataFlight['return_flight']['arrival_airport']['name'] }}
                                    <small style="font-size: 10px">({{ $dataFlight['return_flight']['arrival_airport']['countryName'] }})
                                    </small>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->
        <!-- Body -->
        <div class="card-body py-4 p-md-5">
            <div class="row">
                <div class="col">
                    <ul
                        class="d-block d-md-flex list-group list-group-borderless list-group-horizontal list-group-flush no-gutters">
                        <li
                            class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                            <div class="font-weight-bold text-dark">
                                Baggage</div>
                            <span class="text-gray-1">Adult</span>
                        </li>
                        <li
                            class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                            <div class="font-weight-bold text-dark">
                                Check-in</div>
                            <span class="text-gray-1">15
                                Kgs</span>
                        </li>
                        <li
                            class="mr-md-8 mr-lg-10 mb-5 list-group-item py-0">
                            <div class="font-weight-bold text-dark">
                                Cabin</div>
                            <span class="text-gray-1">7
                                Kgs</span>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <div class="min-width-250">
                        <h5
                            class="font-size-17 font-weight-bold text-dark">
                            Fare breakup</h5>
                        <ul
                            class="list-unstyled font-size-1 mb-0 font-size-16">
                            <li
                                class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium">Base
                                    Fare</span>
                                <span
                                    class="text-secondary">
                                    {{
                                        $dataFlight['departure_flight']['flight_price'] +
                                        $dataFlight['return_flight']['flight_price'] }} $
                                </span>
                            </li>
                            <li
                                class="d-flex justify-content-between py-2">
                                <span
                                    class="font-weight-medium">Surcharges</span>
                                <span
                                    class="text-secondary">€0,00</span>
                            </li>

                            <li
                                class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                <span class="font-weight-bold">Pay
                                    Amount</span>
                                <span class="">
                                    {{
                                        $dataFlight['departure_flight']['flight_price'] +
                                        $dataFlight['return_flight']['flight_price'] }} $
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">AGREED ON THE ABOVE</button>
        </div>
      </div>
    </div>
  </div>
        <!-- ========== END MAIN CONTENT ========== -->
@endsection
@section('js')
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCuY6I4hZQvxo5RqCH7kogGKzcrjetRKQI&callback=initMap"
    async defer></script>

<script>
 $(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        // Check if the clicked circle is disabled
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;
        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        // Check if the next step is not disabled
        if (isValid && !nextStepWizard.hasClass('disabled')) {
            nextStepWizard.trigger('click');
        }
    });

    $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>
<!-- Change the Price of Flight based on Ticket Type and baffages -->
<script>
    $(document).ready(function() {
        // Function to update total price based on selected plan and baggage
        function updateTotalPrice(selectedPlan, subtotal) {
            // Get selected baggage prices
            var baggagePrices = $('input[name="baggage[]"]:checked').map(function() {
                return parseInt($(this).closest('.flight_card').find('.plan-cost').text().replace('$', ''), 10);
            }).get();
            // Calculate the total price including selected baggage
            var extraPrice = baggagePrices.reduce(function(acc, price) {
                return acc + price;
            }, 0);

            var taxPercentage = 0; // You may need to adjust this based on your logic
            var tax = (taxPercentage / 100) * (subtotal + extraPrice);
            var payAmount = subtotal + extraPrice + tax;

            // Update the values in the pay amount section
            $('#basicsCollapseFour .list-unstyled li.ticket  span.text-secondary').text('$' + extraPrice);
            $('#basicsCollapseFour .list-unstyled li:nth-child(4) span.text-secondary').text(tax + ' %');
            $('#basicsCollapseFour .list-unstyled li:nth-child(5) span.text-secondary').text('$' + payAmount);
            $('input.totalpay').val(payAmount);

        }

        // Event handler for plan ticket changes
        $('input[name="plan"]').change(function() {
            var selectedPlan = $('input[name="plan"]:checked').val();

            // Get flight data from the URL
            var urlParams = new URLSearchParams(window.location.search);
            var dataFlight = JSON.parse(urlParams.get('data'));

            // Add the selected plan to the dataFlight object
            // Get selected baggage items
            var selectedBaggage = $('input[name="baggage[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            // Add selected baggage to the flight data
            dataFlight.baggage = selectedBaggage;

            // Get flight price from the server
            $.ajax({
                url: '/changeFlightPrice',
                method: 'GET',
                data: { data: JSON.stringify(dataFlight) , plan:selectedPlan },
                success: function(response) {
                    if (response.status === 'success') {
                       // Check if dataFlight is properly populated
                        // Attempt to access departure_flight and return_flight
                        var departureFlights = response.departure_flight_price;
                        var returnFlights = response.return_flight_price;
                        var leaveflightPrices = parseFloat(response.departure_flight_offer_price);
                        var arriveflightPrices = parseFloat(response.return_flight_offer_price);

                        if(leaveflightPrices > 0){
                            departureFlight = leaveflightPrices;
                        }else{
                            departureFlight = departureFlights
                        }
                        if(arriveflightPrices > 0){
                            returnFlight = arriveflightPrices;
                        }else{
                            returnFlight = returnFlights
                        }

                        // Check if departure_flight and return_flight are defined
                        var flightPrice = departureFlight + returnFlight;

                        var price = parseFloat(response.price);
                        // Update the displayed price in the plan details
                        $('#basicsCollapseFour .list-unstyled li.ticketplan span.text-secondary').text('$' + response.price );
                        var payAmount = flightPrice + price;
                        $('#basicsCollapseFour .list-unstyled li:nth-child(5) span.text-secondary').text('$' + payAmount);
                        $('input.totalpay').val(payAmount);

                        // Update the total price based on selected plan and baggage
                        updateTotalPrice(selectedPlan, payAmount);
                        lastPrice(payAmount);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
        function lastPrice(price){
            // Event handler for checkbox changes
            $('input[name="baggage[]"]').change(function() {
                // Get flight data from the URL
                var urlParams = new URLSearchParams(window.location.search);
                var dataFlight = JSON.parse(urlParams.get('data'));
                var subtotal = price;

                // Update the total price based on selected plan and baggage
                updateTotalPrice($('input[name="plan"]:checked').val(), subtotal);
            });
        }
    });
    </script>
<script>
    // Function to randomly select an available seat
    function selectRandomSeat_leave() {
        // Get all available seats
        var availableSeats = $('input[name="leave_seat"]:not(:disabled):not(:checked)');
        // If there are available seats, randomly select one
        if (availableSeats.length > 0) {
            var randomSeatIndex = Math.floor(Math.random() * availableSeats.length);
            availableSeats.eq(randomSeatIndex).prop('checked', true);
        }
    }
    function selectRandomSeat_return() {
        // Get all available seats
        var availableSeats = $('input[name="return_seat"]:not(:disabled):not(:checked)');
        // If there are available seats, randomly select one
        if (availableSeats.length > 0) {
            var randomSeatIndex = Math.floor(Math.random() * availableSeats.length);
            availableSeats.eq(randomSeatIndex).prop('checked', true);
        }
    }
    // Call the function when the page loads
    $(document).ready(function() {
        selectRandomSeat_leave();
        selectRandomSeat_return();
    });
</script>
<!-- Change the seat and select one -->
<script>
    // Function to dynamically generate seats based on data
    function depruture_flight(dataFlightSeats, selectedSeats) {
        var seatsContainer = $('#leave_flight_seats');
        seatsContainer.empty(); // Clear existing content

        for (var row = 1; row <= Math.ceil(dataFlightSeats / 6); row++) {
            var rowElement = $('<li class="row row--' + row + '"><ol class="seats" type="A"></ol></li>');

            for (var seatNumber = 1; seatNumber <= 6; seatNumber++) {
                var seatId = (row - 1) * 6 + seatNumber;
                var seatLabel = seatId <= dataFlightSeats ? row + String.fromCharCode(64 + seatNumber) : 'Occupied';

                var seatElement = $('<li class="leave_seat seat"><input type="checkbox" name="leave_seat" value="' + seatId + '" id="leave_seat' + seatId + '" ' + (seatLabel == 'Occupied' || selectedSeats.includes('seat' + seatId) ? 'disabled' : '') + '><label for="leave_seat' + seatId + '">' + seatLabel + '</label></li>');

                rowElement.find('.seats').append(seatElement);
            }

            seatsContainer.append(rowElement);

            if (row % 10 === 0 && row < Math.ceil(dataFlightSeats / 6)) {
                seatsContainer.append('<div class="exit exit--back fuselage"></div>');
            }
        }
    }
  // Function to dynamically generate seats based on data
    function return_flight(dataFlightSeats, selectedSeats) {
        var seatsContainer = $('#return_flight_seats');
        seatsContainer.empty(); // Clear existing content

        for (var row = 1; row <= Math.ceil(dataFlightSeats / 6); row++) {
            var rowElement = $('<li class="row row--' + row + '"><ol class="seats" type="A"></ol></li>');

            for (var seatNumber = 1; seatNumber <= 6; seatNumber++) {
                var seatId = (row - 1) * 6 + seatNumber;
                var seatLabel = seatId <= dataFlightSeats ? row + String.fromCharCode(64 + seatNumber) : 'Occupied';
                var seatElement = $('<li class="return_seat seat"><input type="checkbox" name="return_seat" value="' + seatId + '" id="return_seat' + seatId + '" ' + (seatLabel == 'Occupied' || selectedSeats.includes('seat' + seatId) ? 'disabled' : '') + '><label for="return_seat' + seatId + '">' + seatLabel + '</label></li>');

                rowElement.find('.seats').append(seatElement);
            }

            seatsContainer.append(rowElement);

            if (row % 10 === 0 && row < Math.ceil(dataFlightSeats / 6)) {
                seatsContainer.append('<div class="exit exit--back fuselage"></div>');
            }
        }
    }
    // Function to fetch selected seats data
    function selectAllSeats() {

        // Get all flight id
        var flightType = "{{ $flight_type }}";
         // Get all flight id
        var flightIds = $('input[name="flight_id[]"]').map(function(){
            return $(this).val();
        }).get();
        console.log(flightType);
        console.log(flightIds);
        $.ajax({
            type: "POST",
            url: "{{ route('selectseats') }}",
            data: {
                flightIds: flightIds,
                flightType: flightType,
                "_token": $("[name=csrf-token]").attr("content"),
            },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    var departureSeats = response.departure_flight;
                    var returnSeats = response.return_flight;

                    // Convert the received seat data to an array of seat numbers
                    var departureSelectedSeats = departureSeats.map(seat => seat.seat_number);
                    var returnSelectedSeats = returnSeats.map(seat => seat.seat_number);

                    depruture_flight({{ $dataFlight['departure_flight']['flights_seats'] }}, departureSelectedSeats);
                    return_flight({{ $dataFlight['return_flight']['flights_seats'] }}, returnSelectedSeats);
                } else {
                    console.error('Error fetching selected seats.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Ajax request failed:', status, error);
            }
        });
    }

    // Call the function when the document is ready
    $(function () {
        selectAllSeats();
    });
</script>

@endsection

