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
                                    <img class="img-fluid rounded-xs" src="{{ asset($dataFlight['airlines']['airline_logo']) }}"
                                        alt="Image-Description">
                                </a>
                                <a href="#" class="text-dark font-weight-bold mb-1">{{ $dataFlight['airlines']['airline_name'] }}</a>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="flex-horizontal-center text-gray-1">
                                    @if ($flight_type == 'oneway')
                                        Oneway Flight
                                    @else
                                        Return Flight
                                    @endif
                                    </div>
                                    <div class="text-secondary">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal{{ $dataFlight['id'] }}"
                                        class="text-underline text-black">
                                        Info <i class="fa fa-question-circle"
                                        title="view the flight details"
                                        aria-hidden="true"></i> </a>
                                    </div>
                                </div>
                                <div class="flex-content-center flex-column mb-1">
                                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                                        02 hrs 45 mins
                                    </h6>
                                    <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                                    <div class="font-size-14 text-gray-1">
                                       @if($dataFlight['flight_stops'] != 0)
                                       {{ count($dataFlight['flight_stops_country']) }} Stops
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
                                            <h6 style="font-size: 11px" class="font-weight-bold font-size-21 text-gray-5 mb-0">{{ $dataFlight['departure_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['departure_airport']['countryName'] }})
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
                                                {{ $dataFlight['arrival_airport']['name'] }}
                                                <small style="font-size: 10px">({{ $dataFlight['arrival_airport']['countryName'] }})
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
                                                    <span class="text-secondary">{{  $dataFlight['airlines']['airline_name'] }}</span>
                                                </li>

                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Flight type</span>
                                                    <span class="text-secondary">{{  $dataFlight['flight_type'] }}</span>
                                                </li>
                                            </ul>
                                            <!-- End Fact List -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                                <!-- Card -->
                                <div class="card rounded-0 border-top-0 border-left-0 border-right-0 switch-hotel" style="display: none">
                                    <div class="card-header card-collapse bg-transparent border-0"
                                        id="basicsHeadingTwo">
                                        <h5 class="mb-0">
                                            <button type="button"
                                                class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                                data-toggle="collapse" data-target="#basicsCollapseTwo"
                                                aria-expanded="true" aria-controls="basicsCollapseTwo">
                                                Booking Hotel

                                                <span class="card-btn-arrow font-size-14 text-dark">
                                                    <i class="fas fa-chevron-down"></i>
                                                </span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseTwo" class="collapse show" aria-labelledby="basicsHeadingTow"
                                        data-parent="#basicsAccordion">
                                        <div class="card-body px-4 pt-0">
                                            <!-- Fact List -->
                                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Hotel name</span>
                                                    <span class="text-secondary">{{  $dataFlight['airlines']['airline_name'] }}</span>
                                                </li>

                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Flight type</span>
                                                    <span class="text-secondary">{{  $dataFlight['flight_type'] }}</span>
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
                                    @php
                                    if($dataFlight['offer_price'] > 0){
                                    $price = $dataFlight['offer_price'];
                                    }else{
                                    $price = $dataFlight['flight_price'];
                                    }

                                    @endphp
                                    <div id="basicsCollapseFour" class="collapse show"
                                        aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion">
                                        <div class="card-body px-4 pt-0">
                                            <!-- Fact List -->
                                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                                <li class="d-flex justify-content-between py-2">
                                                    <span class="font-weight-medium">Subtotal</span>
                                                    <span class="text-secondary">
                                                        {{ $price }} $
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
                                                <li class="d-flex justify-content-between py-2 price-hotel" style="display: none !important">
                                                    <span class="font-weight-medium">Hotel</span>
                                                    <span class="text-secondary">0 $</span>
                                                </li>
                                                <li
                                                    class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                                    <span class="font-weight-bold">Pay Amount</span>
                                                    <span class="text-secondary">

                                                        {{ $price }} $</span>
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
        id="exampleModal{{ $dataFlight['id'] }}"
        tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel{{ $dataFlight['id'] }}"
        aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel{{ $dataFlight['id'] }}">FLIGHT DETAILS</h5>
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
                          src="{{ asset($dataFlight['airlines']['airline_logo']) }}"
                          alt="Image-Description">
                      <div class="font-size-14">{{$dataFlight['flight_name']}} | {{ $dataFlight['flight_sku'] }}</div>
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
                                18:30</h6>
                            <div class="font-size-14 text-gray-5">
                                Sat, 21 Sep 19</div>
                            <span class="font-size-14 text-gray-1">New
                                Delhi, India</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mb-4 mb-md-0">
                    <div
                        class="mx-2 mx-xl-3 flex-content-center flex-column">
                        <h6
                            class="font-size-14 font-weight-bold text-gray-5 mb-0">
                            02 hrs 45 mins</h6>
                        <div
                            class="width-60 border-top border-primary border-width-2 my-1">
                        </div>
                        <div class="font-size-14 text-gray-1">
                            Non Stop</div>
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
                                21.15</h6>
                            <div class="font-size-14 text-gray-5">
                                Sun, 22 Sep 19</div>
                            <span
                                class="font-size-14 text-gray-1">Bengaluru,
                                India</span>
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
                                    class="text-secondary">€580,00</span>
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
                                <span class="">{{ $price }}</span>
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

<script>
    $(document).ready(function () {

        $('.hotelSwithcer').click(function () {
            if ($(this).is(':checked')) {
                $('.hotel-panel').css('display', 'block');
                $('.hotel-panel').addClass('checked');
                $('.switch-hotel').css('display', 'block');
                $('.price-hotel').css('display', 'block');

            } else {
                $('.hotel-panel').css('display', 'none');
                $('.hotel-panel').removeClass('checked');

                $('.switch-hotel').css('display', 'none');
                $('.price-hotel').css('display', 'none !important');
            }
        });
    });
    $(document).ready(function() {
        // Function to update total price based on selected plan and baggage
        function updateTotalPrice(selectedPlan,subtotal) {
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
            $('#basicsCollapseFour .list-unstyled li:nth-child(4) span.text-secondary').text( '0 %');
            $('#basicsCollapseFour .list-unstyled li:nth-child(6) span.text-secondary').text('$' + payAmount);
            $('input.totalpay').val(payAmount);

        }

        // in case the user did not select the plan nor bagged so calculate price hotel with flight
        var urlParams = new URLSearchParams(window.location.search);
        var dataFlight = JSON.parse(urlParams.get('data'));
        if(dataFlight.offer_price > 0){
            pricehotel = dataFlight.offer_price
        }else{
            pricehotel = dataFlight.flight_price
        }
        HotelPrice(pricehotel);


        // Event handler for plan ticket changes
        $('input[name="plan"]').change(function() {
            var selectedPlan = $('input[name="plan"]:checked').val();

            // Get flight data from the URL
            var urlParams = new URLSearchParams(window.location.search);
            var dataFlight = JSON.parse(urlParams.get('data'));

            // Update the selected plan in the flight data
            dataFlight.plan = selectedPlan;

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
                data: { data: JSON.stringify(dataFlight) },
                success: function(response) {
                    if (response.status === 'success') {
                        var offerPrice = parseFloat(dataFlight.offer_price)
                        var flightPrices = parseFloat(dataFlight.flight_price);
                        if(offerPrice > 0){
                            flightPrice = offerPrice;
                        }else{
                            flightPrice = flightPrices
                        }
                        var price = parseFloat(response.price);
                        // Update the displayed price in the plan details
                        $('#basicsCollapseFour .list-unstyled li.ticketplan span.text-secondary').text('$' + response.price );
                        var payAmount = flightPrice + price;
                        $('#basicsCollapseFour .list-unstyled li:nth-child(6) span.text-secondary').text('$' + payAmount);
                        $('input.totalpay').val(payAmount);

                        // hotel price

                        var hotelprice = parseFloat($('input[name="hotel-plan"]:checked').val());
                        if(hotelprice != 'undefined' || hotelprice != 'NaN'){
                            hotelPrice = 0;
                        }
                        // Update the total price based on selected plan and baggage
                        updateTotalPrice(selectedPlan, payAmount);
                        lastPrice(payAmount);
                        HotelPrice(payAmount);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
        function HotelPrice(amount){
            $('input[name="hotel-plan"]').click(function () {
            // Change the price based on the hotel
                //START TO GET THE PRICES OF HOTELS
                var hotelPrice = parseFloat($('input[name="hotel-plan"]:checked').val());
                var   payAmount = amount + hotelPrice;
                $('#basicsCollapseFour .list-unstyled li:nth-child(5) span.text-secondary').text('$ ' + hotelPrice );
                $('#basicsCollapseFour .list-unstyled li:nth-child(6) span.text-secondary').text('$' + payAmount);
                $('input.totalpay').val(payAmount);
                $('input.hotel_plan_price').val(hotelPrice);
                lastPrice(payAmount);
                });
        }

        function lastPrice(price){
            // Event handler for checkbox changes
            $('input[name="baggage[]"]').change(function() {
                // Get flight data from the URL
                var urlParams = new URLSearchParams(window.location.search);
                var dataFlight = JSON.parse(urlParams.get('data'));
                var subtotal = price;
                // Update the total price based on selected plan and baggage
                updateTotalPrice($('input[name="plan"]:checked').val(),subtotal);
            });
        }

    });
    </script>
<script>
    // Function to randomly select an available seat
    function selectRandomSeat() {
        // Get all available seats
        var availableSeats = $('input[name="seat"]:not(:disabled):not(:checked)');
        // If there are available seats, randomly select one
        if (availableSeats.length > 0) {
            var randomSeatIndex = Math.floor(Math.random() * availableSeats.length);
            availableSeats.eq(randomSeatIndex).prop('checked', true);
        }
    }
    // Call the function when the page loads
    $(document).ready(function() {
        selectRandomSeat();
    });
</script>

<script>
    // Function to dynamically generate seats based on data
    function generateSeats(dataFlightSeats, selectedSeats) {
        var seatsContainer = $('.rowseat');
        seatsContainer.empty(); // Clear existing content

        for (var row = 1; row <= Math.ceil(dataFlightSeats / 6); row++) {
            var rowElement = $('<li class="row row--' + row + '"><ol class="seats" type="A"></ol></li>');

            for (var seatNumber = 1; seatNumber <= 6; seatNumber++) {
                var seatId = (row - 1) * 6 + seatNumber;
                var seatLabel = seatId <= dataFlightSeats ? row + String.fromCharCode(64 + seatNumber) : 'Occupied';

                var seatElement = $('<li class="seat"><input type="checkbox" name="seat" value="seat' + seatId + '" id="' + seatId + '" ' + (seatLabel == 'Occupied' || selectedSeats.includes('seat' + seatId) ? 'disabled' : '') + '><label for="' + seatId + '">' + seatLabel + '</label></li>');

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
        var flight_id = $('#flight_id').val();
        $.ajax({
            type: "POST",
            url: "{{ route('selectseats') }}",
            data: {
                flight_id: flight_id,
                flightType: flightType,
                "_token": $("[name=csrf-token]").attr("content"),
            },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    generateSeats({{ $dataFlight['flights_seats'] }}, response.seats);
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

