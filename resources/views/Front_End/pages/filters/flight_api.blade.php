<div id="sidebar" class="collapse navbar-collapse">
    <div class="mb-6 w-100">

        <div class="sidenav border border-color-8 rounded-xs">
            <form class="js-validate" id="hotel_filter" action="{{ route('flightfilter') }}" method="POST">
                @csrf
                <div id="shopCartAccordion" class="accordion rounded shadow-none">
                    <div class="border-0">
                        <div class="card-collapse" id="shopCardHeadingOne">
                            <h3 class="mb-0">
                                <button type="button"
                                    class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                    data-toggle="collapse" data-target="#shopCardOne" aria-expanded="false"
                                    aria-controls="shopCardOne">
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
                        <div id="shopCardOne" class="collapse show" aria-labelledby="shopCardHeadingOne"
                            data-parent="#shopCartAccordion">
                            <div class="card-body pt-0 px-5 row" style="margin-top: 3px;margin-bottom:3px">

                                <div class="col-12 col-md-6">
                                    <input type="number" name="min_price" data-min="100" value="100"
                                        class="text-center min_price form-control form-control-sm" placeholder="$min"
                                        style="padding:3px 5px">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="number" data-max="100" value="100" name="max_price"
                                        class="text-center max_price form-control form-control-sm" placeholder="$max"
                                        style="padding:3px 5px">
                                </div>
                                <div class="col-12 col-md-12">

                                    <button style="width: 100%" type="submit"
                                        class="btn btn-dark btn-rounded mt-2">PRICE FILTER</button>
                                </div>
                                <p class="text-center w-100">
                                    <small class="text-center">Rang of search between 100 - 100
                                    </small>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form class="js-validate" id="hotel_filter" action="{{ route('flightfilter') }}" method="POST">
                @csrf
                <div id="shopCategoryAccordion" class="accordion rounded-0 shadow-none border-top">
                    <div class="border-0">
                        <div class="card-collapse" id="shopCategoryHeadingOne">
                            <h3 class="mb-0">
                                <button type="button"
                                    class="btn btn-link btn-block card-btn py-2 px-5 text-lh-3 collapsed"
                                    data-toggle="collapse" data-target="#shopCategoryOne" aria-expanded="false"
                                    aria-controls="shopCategoryOne">
                                    <span class="row align-items-center">
                                        <span class="col-9">
                                            <span class="font-weight-bold font-size-17 text-dark mb-3">Flights Stops
                                            </span>
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
                        <div id="shopCategoryOne" class="collapse show" aria-labelledby="shopCategoryHeadingOne"
                            data-parent="#shopCategoryAccordion">
                            <div class="card-body pt-0 mt-1 px-5 pb-4">
                                <!-- Checkboxes -->

                                <div class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" checked name="flight_stops[]" value=""
                                            class="custom-control-input flight-filter" onchange="this.form.submit();"
                                            id="flight_stops">
                                        <label class="custom-control-label" for="flight_stops">
                                            STOP(S)</label>
                                    </div>
                                </div>

                                <!-- End Checkboxes -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <!-- End Accordion -->
</div>
