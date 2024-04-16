@extends('Front_End.layout.main_desgin')
@section('title','Packages Page')
@section('content')

<main id="content" role="main">
    <div class="container pt-5 pt-xl-8">
        <div class="row mb-5 mb-md-8 mt-xl-1 pb-md-1">
            <div class="col-lg-4 col-xl-3 order-lg-1 width-md-50">
                <div class="navbar-expand-lg navbar-expand-lg-collapse-block">
                    <button class="btn d-lg-none mb-5 p-0 collapsed" type="button" data-toggle="collapse"
                        data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                        <span class="text-primary ml-2">Sidebar</span>
                    </button>
                   @include('Front_End.pages.filters.package_filter')
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 order-md-1 order-lg-2">
                <!-- Shop-control-bar Title -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="font-size-21 font-weight-bold mb-0 text-lh-1">Resualts: {{ count($packages) }} Packages found</h3>
                    <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-size-22 p-0" id="pills-three-example1-tab" data-toggle="pill"
                                href="#pills-three-example1" role="tab" aria-controls="pills-three-example1"
                                aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-list"></i>
                                </div>
                            </a>
                        </li>
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
                                @foreach ($packages as $package)
                                <div class="col-md-6 col-xl-4 mb-3 mb-md-4 pb-1">
                                    <div class="card mb-1 transition-3d-hover shadow-hover-2 tab-card h-100">
                                        <div class="position-relative mb-2">
                                            <a href="{{ route('singletour',$package->slug) }}"
                                                class="d-block gradient-overlay-half-bg-gradient-v5">
                                                <img class="min-height-230 bg-img-hero card-img-top"
                                                    src="{{ asset($package->image) }}" alt="img" style="height: 300px;object-fit:cover">
                                            </a>

                                            @if($package-> discound > 0)
                                            <div class="position-absolute top-0 left-0 pt-5 pl-3">
                                                <span
                                                    class="badge badge-pill bg-white text-primary px-4 py-2 font-size-14 font-weight-normal">Discound</span>
                                                <span
                                                    class="badge badge-pill bg-white text-danger px-3 ml-3 py-2 font-size-14 font-weight-normal">%{{ $package-> discound}}</span>
                                            </div>
                                                @endif
                                            <div class="position-absolute bottom-0 left-0 right-0">
                                                <div class="px-3 pb-2">
                                                    @if($package->offer_price > 0)
                                                    <h2 class="h5 text-white mb-0 font-weight-bold"><small
                                                        class="mr-2">From</small>{{ $package->offer_price }} $ - <del><span style="color: red;font-size:16px">{{ $package->price }} $</span></del><h2>
                                                    @else
                                                    <h2 class="h5 text-white mb-0 font-weight-bold"><small
                                                        class="mr-2">From</small>{{ $package->price }} $<h2>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-4 py-2">
                                            <a href="{{ route('singletour',$package->slug) }}" class="d-block">
                                                <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                                                    <i class="icon flaticon-pin-1 mr-2 font-size-15"></i>
                                                    {{ \App\Helpers\MyFunctions::getCityName($package->loca_city,'city') }},
                                                    {{ \App\Helpers\MyFunctions::getCountryName($package->loca_country,'country')  }}
                                                </div>
                                            </a>
                                            <a href="{{ route('singletour',$package->slug) }}"
                                                class="card-title font-size-17 font-weight-bold mb-0 text-dark">{{$package->name}}</a>
                                            <div class="my-2">
                                                <div
                                                    class="d-inline-flex align-items-center font-size-17 text-lh-1 text-primary">
                                                    <div class="green-lighter mr-2">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                                                <a class="text-black" href="{{ $package->map }}">
                                                <i class="icon flaticon-placeholder mr-2 font-size-14"></i>

                                                View location on map
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{ $packages->links() }}
                </div>
            </div>
            <!-- Slick Tab carousel -->
        </div>
    </div>
    </div>
</main>
@endsection
