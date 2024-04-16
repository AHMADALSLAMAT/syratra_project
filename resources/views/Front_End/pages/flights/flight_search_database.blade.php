@extends('Front_End.layout.main_desgin')
@section('title','Flights Page')
@section('content')
<main id="content" role="main">
    <div class="bg-gray-33 py-1">
        <div class="container">
            <div class="border-0">
                <div class="card-body">
                    <ul class="nav tab-nav tab-nav-1-inner flex-nowrap pb-2 mb-md-1 px-lg-3 px-2" role="tablist">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row pt-5 pt-xl-8 mb-5 mb-xl-9 pb-xl-1">
            <div class="col-lg-4 col-xl-3 mt-xl-1">
                <div class="navbar-expand-xl navbar-expand-xl-collapse-block">
                    <button class="btn d-xl-none mb-5 p-0 collapsed" type="button" data-toggle="collapse"
                        data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="far fa-caret-square-down text-primary font-size-20 card-btn-arrow ml-0"></i>
                        <span class="text-primary ml-2">Sidebar</span>
                    </button>
                    @include('Front_End.pages.filters.flight_api')
                </div>
            </div>
            <div class="col-xl-9 mt-xl-1">
                <!-- Shop-control-bar Title -->
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 pb-1">
                    <h3 class="font-size-21 font-weight-bold mb-4 mb-md-0 text-lh-1 text-center text-md-left">
                        results found.</h3>
                    <div class="d-flex align-items-center justify-content-between justify-content-md-start">
                        <ul class="nav tab-nav-shop flex-nowrap" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-size-22 p-0 ml-4 active" id="pills-three-example1-tab"
                                    data-toggle="pill" href="#pills-three-example1" role="tab"
                                    aria-controls="pills-three-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End shop-control-bar Title -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                        @if (!empty($resultSearch['return_flight']) && $resultSearch['isRoundTrip'] == true)
                        @include('Front_End.pages.flights.flights_cards.flight_with_return')
                        @else
                        @include('Front_End.pages.flights.flights_cards.flight_same_leave_airport')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofKuLzoUp+9msz0NlJZ+uaG5pfabzZOrO" crossorigin="anonymous"></script>
@section('js')
<script>
    // Send an Ajax request
    $(document).ready(function() {
        $('.booknowbtn').click(function (e) {
            e.preventDefault();
            var departure_flight_id = $(this).data('flight_leave');
            var return_flight_id = $(this).data('return_flight');
            $.ajax({
                type: "POST",
                url: "{{ route('flightbooking_post') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    departure_flight_id: departure_flight_id,
                    return_flight_id: return_flight_id
                },
                success: function(response) {

                    if (response.status == 401) {
                        window.location.href = "{{ route('front.login') }}"; // Assuming you're using a templating engine like Blade
                    } else {
                        if (response.status == 200) {
                            // Redirect to the flightbooking page
                            window.location.href = response.redirect;
                        } else {
                            // Handle other responses or actions
                            alert('something went wrong in your data flight');
                        }
                    }
                },
                error: function (response) {

                    if (response.status == 401) {
                        window.location.href = "{{ route('front.login') }}"; // Assuming you're using a templating engine like Blade
                    }
                }
            });
        });
    });
</script>
@stop
