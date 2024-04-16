<div class="border border-color-7 rounded mb-5">
    <div class="border-bottom">
        <div class="p-4">
            <span class="font-size-14">From</span>
            <span class="font-size-24 text-gray-6 font-weight-bold ml-1" id="totalPrice">
                @if($package->offer_price > 0)
                {{ $package->offer_price }}
                @else
                {{ $package->price }}
                @endif
                $ /
                <small>Per person</small></span>
        </div>
    </div>
    <div class="p-4">
        <!-- Input -->
        <span class="d-block text-gray-1 font-weight-normal mb-0 text-left">Duration</span>
        <div class="mb-4">
            <div class="border-bottom border-width-2 border-color-1">
                <div id="datepickerWrapperPick" class="u-datepicker input-group">
                    <input
                        class=" w-auto height-40 font-size-16 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0"
                        type="text" placeholder="{{ $package->days }} Days" aria-label="{{ $package->days }} Days"
                        data-rp-wrapper="#datepickerWrapperPick" data-rp-date-format="M d / Y"
                        data-rp-default-date='{{ $package->days }} Days' disabled>
                </div>
                <!-- End Datepicker -->
            </div>
        </div>
        <!-- End Input -->

        <!-- Start the booking form -->
        <form  action="{{ route('toursbooking', $package->id) }}" method="post">
            @csrf
            <!-- Input -->
            <input id="pakcage_id" type="hidden" name="pakcage_id" value="{{ $package->id }}">
            <span class="d-block text-gray-1 font-weight-normal mb-2 text-left">Adults</span>
            <div class="mb-4">
                <div class="border-bottom border-width-2 border-color-1 pb-1">
                    <div class="js-quantity flex-center-between mb-1 text-dark font-weight-bold">
                        <span class="d-block">Age 18+</span>
                        <div class="flex-horizontal-center">
                            <a class="js-minus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                            <input
                                class="js-result form-control h-auto width-30 font-weight-bold font-size-16 shadow-none bg-tranparent border-0 rounded p-0 mx-1 text-center"
                                type="text" name="adults" value="1" min="0" max="10" id="adultsQty">
                            <a class="js-plus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Input -->
            <!-- Input -->
            <span class="d-block text-gray-1 font-weight-normal mb-2 text-left">Children (+70%)</span>
            <div class="mb-4">
                <div class="border-bottom border-width-2 border-color-1 pb-1">
                    <div class="js-quantity flex-center-between mb-1 text-dark font-weight-bold">
                        <span class="d-block">Age 6-17</span>
                        <div class="flex-horizontal-center">
                            <a class="js-minus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                            <input
                                class="js-result form-control h-auto width-30 font-weight-bold font-size-16 shadow-none bg-tranparent border-0 rounded p-0 mx-1 text-center"
                                type="text" value="0" name="children" min="0" max="10" id="childrenQty">
                            <a class="js-plus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Input -->

            <!-- Input -->
            <span class="d-block text-gray-1 font-weight-normal mb-2 text-left">Infant (+20%)</span>
            <div class="mb-4">
                <div class="border-bottom border-width-2 border-color-1 pb-1">
                    <div class="js-quantity flex-center-between mb-1 text-dark font-weight-bold">
                        <span class="d-block">Age 0-5</span>
                        <div class="flex-horizontal-center">
                            <a class="js-minus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-up"></i>
                            </a>
                            <input
                                class="js-result form-control h-auto width-30 font-weight-bold font-size-16 shadow-none bg-tranparent border-0 rounded p-0 mx-1 text-center"
                                type="text" value="0" name="infant" min="0" max="4" id="infantQty">
                            <a class="js-plus font-size-10 text-dark" href="javascript:;">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Input -->

            <input type="hidden" name="package_id" id="pakcage_id" value="{{ $package->id }}">
            <input type="hidden" name="fullPrice" id="fullPrice" value="
            @if($package->offer_price > 0)
            {{ $package->offer_price }}
            @else
            {{ $package->price }}
            @endif
            "
            >
        </form>

        <!-- Start the booking form -->
        <div class="text-center">
            <a href="#" onclick="submitForm()"
                class="btn btn-primary d-flex align-items-center justify-content-center  height-60 w-100 mb-xl-0 mb-lg-1 transition-3d-hover font-weight-bold">Book
                Now</a>
        </div>
    </div>
</div>
