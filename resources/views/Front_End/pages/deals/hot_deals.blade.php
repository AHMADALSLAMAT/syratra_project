@extends('Front_End.layout.main_desgin')
@section('title','Hotel Page')
@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="mt-7 mb-7">
    <div class="row">
        @foreach ($hotdeals_hotels as $rooms)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
            <div class="card mb-1 transition-3d-hover shadow-hover-2 tab-card h-100">
                <div class="position-relative mb-2">
                    <a href="{{ route('singlehotel',$rooms->Hotel->slug) }}"
                        class="d-block gradient-overlay-half-bg-gradient-v5">
                        <img class="card-img-top" src="{{ asset($rooms->Hotel->hotel_image) }}"
                            alt="img" style="height: 300px;object-fit:cover">
                    </a>

                    @if($rooms-> discound > 0)
                    <div class="position-absolute top-0 left-0 pt-5 pl-3">
                        <span
                            class="badge badge-pill bg-white text-primary px-4 py-2 font-size-14 font-weight-normal">Discound</span>
                        <span
                            class="badge badge-pill bg-white text-danger px-3 ml-3 py-2 font-size-14 font-weight-normal">%{{ $rooms-> discound}}</span>
                    </div>
                        @endif
                </div>
                <div class="card-body px-4 py-2">
                    <a href="{{ route('view_hotel') }}" class="d-block">
                        <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                            <span class="badge badge-info"> HOTELS </span>
                        </div>
                    </a>
                    <a href="{{ route('singlehotel',$rooms->Hotel->slug) }}"
                        class="card-title font-size-17 font-weight-bold mb-0 text-dark">{{$rooms->Hotel->hotel_name}}</a>
                </div>
            </div>
        </div>
        @endforeach
        @foreach ($hotdeals_packages as $package)
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
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
                    <a href="{{ route('view_tour') }}" class="d-block">
                        <div class="mb-1 d-flex align-items-center font-size-14 text-gray-1">
                           <span class="badge badge-primary"> Package </span>
                        </div>
                    </a>
                    <a href="{{ route('singletour',$package->slug) }}"
                        class="card-title font-size-17 font-weight-bold mb-0 text-dark">{{$package->name}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</main>


@endsection
