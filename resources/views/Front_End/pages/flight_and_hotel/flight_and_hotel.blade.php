@extends('Front_End.layout.main_desgin')
@section('title','Flights & Hotels Page')
@section('content')
<main id="content" role="main">
    <div class="bg-gray-33 py-1">
        <div class="container">
            <div class="border-0">
                <div class="card-body">
                    <ul class="nav tab-nav tab-nav-1-inner flex-nowrap pb-2 mb-md-1 px-lg-3 px-2" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-shrink-md-1">
                            <a class="nav-link font-weight-medium active" id="pills-one-example2-tab" data-toggle="pill"
                                href="#pills-one-example2" role="tab" aria-controls="pills-one-example2"
                                aria-selected="true">
                                <div
                                    class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                    <span class="tabtext font-size-12 font-weight-semi-bold">Search For Flight</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content hero-tab-pane">
                        @include('Front_End.pages.flights.flight_searchform')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
