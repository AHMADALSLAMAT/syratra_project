@extends('Front_End.layout.main_desgin')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="bg-gray space-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                @include('Front_End.pages.hotels.form.main_form')
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="shadow-soft bg-white rounded-sm">
                    <div class="pt-5 pb-3 px-5 border-bottom">
                        <a href="#" class="d-block mb-3">
                            <img class="img-fluid rounded-xs" src="{{ asset($room_info->room_image) }}"
                                alt="Image-Description">
                        </a>
                        <a href="#" class="text-dark font-weight-bold pr-xl-1">
                            {{ $room_info->Hotel->hotel_name }}
                        </a>
                        <div class="my-1 flex-horizontal-center text-gray-1">
                            <i class="icon flaticon-pin-1 mr-2 font-size-15"></i>
                            {{ \App\Helpers\MyFunctions::getCityName($room_info->Hotel->loca_city,'city') }},
                            {{ \App\Helpers\MyFunctions::getCountryName($room_info->Hotel->loca_country,'country')  }}
                        </div>
                    </div>
                    <!-- Basics Accordion -->
                    <div id="basicsAccordion">
                        <!-- Card -->
                        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                            <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingOne">
                                <h5 class="mb-0">
                                    <button type="button"
                                        class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                        data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true"
                                        aria-controls="basicsCollapseOne">
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
                                            <span class="font-weight-medium">Stay Period </span>

                                            <span class="text-secondary" style="font-size: 12px" id="datetime">
                                                {{ now() }} <br>
                                            </span>
                                        </li>
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Stay</span>
                                            <span class="text-secondary" id="datenumber">1 Night</span>
                                        </li>
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Room</span>
                                            <span class="text-secondary">
                                                {{ $room_info->num_of_rooms }} Room(s)
                                            </span>
                                        </li>
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">beds</span>
                                            <span class="text-secondary">
                                                {{ $room_info->room_beds }}
                                            </span>
                                        </li>
                                    </ul>
                                    <!-- End Fact List -->
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->

                        <!-- Card -->
                        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                            <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingFour">
                                <h5 class="mb-0">
                                    <button type="button"
                                        class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                        data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false"
                                        aria-controls="basicsCollapseFour">
                                        Payment
                                        <span class="card-btn-arrow font-size-14 text-dark">
                                            <i class="fas fa-chevron-down"></i>
                                        </span>
                                    </button>
                                </h5>
                            </div>
                            <div id="basicsCollapseFour" class="collapse show" aria-labelledby="basicsHeadingFour"
                                data-parent="#basicsAccordion">
                                <div class="card-body px-4 pt-0">
                                    <!-- Fact List -->
                                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Subtotal</span>
                                            <span class="text-secondary">
                                                @if ($room_info->offer_price > 0)
                                                    {{ number_format($room_info->offer_price) }} $
                                                    @else
                                                    {{ number_format($room_info->room_price) }} $
                                                @endif
                                            </span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Extra Price</span>
                                            <span class="text-secondary">€0,00</span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2">
                                            <span class="font-weight-medium">Tax</span>
                                            <span class="text-secondary">0 %</span>
                                        </li>

                                        <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                            <span class="font-weight-bold">Pay Amount</span>
                                            <span class="" id="total">
                                                @if ($room_info->offer_price > 0)
                                                    {{ number_format($room_info->offer_price) }} $
                                                    @else
                                                    {{ number_format($room_info->room_price) }} $
                                                @endif
                                            </span>
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
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

@endsection
@section('js')

<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCuY6I4hZQvxo5RqCH7kogGKzcrjetRKQI&callback=initMap" async
    defer></script>

<script>
    $(document).ready(function() {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
        allWells.hide();
        navListItems.click(function(e) {
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
        allNextBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                .children("a"),
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
    document.getElementById('staydate').addEventListener('change', updateSidebar);
    document.getElementById('leavedate').addEventListener('change', updateSidebar);
    var roomInfo = <?php echo json_encode($room_info); ?>;
    if(roomInfo.offer_price > 0){
        var price = roomInfo.offer_price;
    }else{
        var price = roomInfo.room_price;
    }
    function updateSidebar() {
        var stayDate = new Date(document.getElementById('staydate').value);
        var leaveDate = new Date(document.getElementById('leavedate').value);

        var timeDifference = leaveDate.getTime() - stayDate.getTime();
        var nightDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

        if(nightDifference == 0 || nightDifference < 0){
            var total = price;

            document.getElementById('datenumber').innerText =  '1 Night';
            document.getElementById('datetime').innerText =
            'Wrong Input Date'
            document.getElementById('total').innerText = price  + ' $';
            document.getElementById('totalPrice').value = total; // Corrected line
        }

        if(nightDifference > 0){
            var total = price * nightDifference;
            document.getElementById('datenumber').innerText =
            nightDifference + (nightDifference === 1 ? ' Night' : ' Nights');
            document.getElementById('datetime').innerText =
        stayDate.toLocaleDateString() + ' - ' + leaveDate.toLocaleDateString();
            document.getElementById('total').innerText = price * nightDifference + ' $';
            document.getElementById('totalPrice').value = total; // Corrected line
            document.getElementById('number_of_nights').value = nightDifference; // Corrected line
            document.getElementById('leave_date').value = leaveDate.toLocaleDateString(); // Corrected line
            document.getElementById('stay_date').value = stayDate.toLocaleDateString(); // Corrected line
        }
    }
</script>
@stop
