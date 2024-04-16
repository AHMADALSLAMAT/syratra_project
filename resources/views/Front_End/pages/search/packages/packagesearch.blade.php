   <!-- ========== MAIN CONTENT ========== -->
   <main id="content" role="main">
    <div class="container pt-5 pt-xl-8">
        <div class="row mb-5 mb-lg-8 mt-xl-1">

            <div class="col-lg-12 col-xl-12 order-md-1 order-lg-2 pb-5 pb-lg-0">
                <!-- Shop-control-bar Title -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="font-size-21 font-weight-bold mb-0 text-lh-1">Search: found {{ count($data['package_data']) }} Releated  Packages </h3>
                    <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link font-size-22 p-0 ml-2 active" id="pills-one-example1-tab"
                                data-toggle="pill" href="#pills-one-example1" role="tab"
                                aria-controls="pills-one-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-th"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End shop-control-bar Title -->

                <!-- Slick Tab carousel -->
                <div class="u-slick__tab">


                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                            aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                            <div class="row">
                                @foreach ($data['package_data'] as $item)
                                <div class="col-md-6 col-lg-4 mb-3 mb-md-4 pb-1">
                                    <div class="card transition-3d-hover shadow-hover-2 tab-card h-100">
                                        <div class="position-relative">
                                            <a href="{{ route('singletour',$item['slug']) }}"
                                                class="d-block gradient-overlay-half-bg-gradient-v5">
                                                <img class="min-height-230 bg-img-hero card-img-top"
                                                    src="{{ asset($item['image']) }}" alt="img" style="height: 300px;object-fit:cover">
                                            </a>
                                            @if($item['discound'] > 0)
                                            <div class="position-absolute top-0 left-0 pt-5 pl-3">
                                                <span
                                                    class="badge badge-pill bg-white text-primary px-4 py-2 font-size-14 font-weight-normal">Discound</span>
                                                <span
                                                    class="badge badge-pill bg-white text-danger px-3 ml-3 py-2 font-size-14 font-weight-normal">%{{ $item['discound']}}</span>
                                            </div>
                                                @endif
                                            <div class="position-absolute bottom-0 left-0 right-0">
                                                <div class="px-4 pb-3">
                                                    <a href="{{ route('singletour',$item['slug']) }}" class="d-block">
                                                        <div
                                                            class="d-flex align-items-center font-size-14 text-white">
                                                            <i
                                                                class="icon flaticon-pin-1 mr-2 font-size-20"></i>
                                                                {{ \App\Helpers\MyFunctions::getCityName($item['loca_city'],'city') }},
                                                                {{ \App\Helpers\MyFunctions::getCountryName($item['loca_country'],'country')  }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pl-3 pr-4 pt-2 pb-3">
                                            <div class="ml-1 mb-2">
                                                <div
                                                    class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary letter-spacing-3">
                                                    <div class="green-lighter">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('singletour',$item['slug']) }}"
                                                class="card-title font-size-17 font-weight-medium text-dark">{{$item['name']}}</a>
                                            <div class="mt-2 mb-3">
                                                <span
                                                    class="badge badge-pill badge-primary py-1 px-2 font-size-14 border-radius-3 font-weight-normal">{{ $item['days'] }}</span>
                                                <span class="font-size-14 text-gray-1 ml-2">DAYS</span>
                                            </div>
                                            <div class="mb-0">
                                                <div class="px-3 pb-2">
                                                    @if($item['offer_price'] > 0)
                                                    <h2 class="h5 text-black mb-0 font-weight-bold"><small
                                                        class="mr-2">From</small>{{ $item['offer_price'] }} $ - <del><span style="color: #ccc;font-size:16px">
                                                            {{ $item['price'] }} $</span></del><h2>
                                                    @else
                                                    <h2 class="h5 text-black mb-0 font-weight-bold"><small
                                                        class="mr-2">From</small>{{ $item['price'] }} $ <h2>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- Slick Tab carousel -->
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
