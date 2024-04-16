<div id="sidebar" class="collapse navbar-collapse">
    <div class="mb-6 w-100">

        <div class="sidenav border border-color-8 rounded-xs">
            <form class="js-validate" id="hotel_filter" action="{{ route('packagefilter') }}" method="POST" >
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
                                data-min="{{ App\Helpers\Filter::minPrice() }}"
                                @if (!empty($_GET['price'])) value="{{ $price[0] }}"
                                @else
                                value="{{ App\Helpers\Filter::minPrice() }}"
                                @endif
                                class="text-center min_price form-control form-control-sm"
                                placeholder="$min"
                                style="padding:3px 5px">
                            </div>
                            <div class="col-12 col-md-6">
                                <input
                                type="number"
                                data-max="{{ App\Helpers\Filter::maxPrice() }}"
                                @if (!empty($_GET['price']))
                                value="{{ $price[1] }}"
                                @else
                                value="{{ App\Helpers\Filter::maxPrice() }}"
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
                                <small class="text-center">Rang of search between {{ App\Helpers\Filter::minPrice() }} - {{ App\Helpers\Filter::maxPrice() }}
                                </small>
                                </p>

                     </div>
                    </div>
                </div>
            </div>
        </form>
            <form class="js-validate" id="hotel_filter" action="{{ route('packagefilter') }}" method="POST" >
                @csrf
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">PACKAGE DAYS </span>
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
                            @if (!empty($_GET['package_days']))
                            @php
                            $filter_hotel = explode(',',$_GET['package_days']);
                            @endphp
                            @endif
                            @foreach ($package_days as $hotel )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($filter_hotel) && in_array($hotel->days,$filter_hotel))
                                    checked
                                    @endif
                                    name="package_days[]"
                                    value="{{ $hotel->days }}"
                                    class="custom-control-input hotel-filter"
                                    onchange="this.form.submit();"
                                    id="package_days{{ $hotel->days }}">
                                    <label class="custom-control-label"
                                    for="package_days{{ $hotel->days }}">{{ $hotel->days }} DAYS</label>
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">TYPE OF PACKAGE</span>
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
                             @if (!empty($_GET['package_type']))
                             @php
                             $filter_hotel_type = explode(',',$_GET['package_type']);
                             @endphp
                             @endif
                             @foreach ($package_type as $key => $type )
                             <div
                                 class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox"
                                     @if (!empty($filter_hotel_type) && in_array($type->package_type,$filter_hotel_type))
                                     checked
                                     @endif
                                     name="package_type[]"
                                     value="{{ $type->package_type }}"
                                     class="custom-control-input hotel-filter"
                                     onchange="this.form.submit();"
                                     id="package_type{{ $key }}">
                                     <label class="custom-control-label"
                                     for="package_type{{ $key }}">{{ $type->package_type }}</label>
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
                                            class="font-weight-bold font-size-17 text-dark mb-3">PACKAGE LOCATION</span>
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
                            @if (!empty($_GET['package_location']))
                            @php
                            $filter_hotel_location = explode(',',$_GET['package_location']);
                            @endphp
                            @endif
                            @foreach ($packagelocation as $key => $location )
                            <div
                                class="form-group font-size-14 text-lh-md text-secondary mb-3 flex-center-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                    @if (!empty($filter_hotel_location) && in_array($location->loca_country,$filter_hotel_location))
                                    checked
                                    @endif
                                    name="package_location[]"
                                    value="{{ $location->loca_country }}"
                                    class="custom-control-input hotel-filter"
                                    onchange="this.form.submit();"
                                    id="package_location{{ $key }}">
                                    <label class="custom-control-label"
                                    for="package_location{{ $key }}">
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
        </form>
        </div>

    </div>
</div>

