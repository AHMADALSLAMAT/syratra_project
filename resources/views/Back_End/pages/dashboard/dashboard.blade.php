@extends('Back_End.layout.main_desgin')

@section('content')
    <!--start content-->
<main class="page-content">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
       @include('Back_End.pages.dashboard.cards.top_card')
    </div>
    @if (Auth::guard('admin')->user()->role !== 'Editor')
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        @include('Back_End.pages.dashboard.cards.total_revenu')
     </div>
     @endif
    <!--end row-->
    @if (Auth::guard('admin')->user()->role !== 'Editor')
    <div class="card radius-10 mt-5 w-100 mb-0">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Recent (10) Orders</h6>
            </div>
            <div class="table-responsive mt-2">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Orders Ref</th>
                            <th>User ID</th>
                            <th>Order Type</th>
                            <th>Payment Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latest_order_ten as $order )
                        <tr>
                            <td>
                                {{ $order->id }}
                            </td>
                            <td>
                                {{ $order->order_ref }}
                            </td>
                            <td>
                                {{ $order->user_id }}
                            </td>
                            <td>
                            @if ($order->flight_id != null)
                            Flight Id : {{ $order->flight_id }}
                            @elseif ($order->package_id != null)
                            Package Id : {{ $order->package_id }}
                            @else
                            Hotel id : {{ $order->hotel_id }}
                            @endif
                            </td>
                            <td>
                                {{ $order->payment_type }}
                            </td>
                            <td>
                                {{ $order->user_fname .' '. $order->user_lname }}
                            </td>
                            <td>
                                {{ $order->user_email }}
                            </td>
                            <td>
                                {{ $order->user_phone }}
                            </td>
                            <td>
                                {{ $order->amount }} $
                            </td>
                            <td>
                                {{ $order->booking_status  }}
                            </td>

                        </tr
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card radius-10 mt-5 w-100 mb-0">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Recent (10) VIEWS OF CLIENTS</h6>
            </div>
            <div class="table-responsive mt-2" style="white-space:normal !important">
                <table class="table align-middle mb-0" >
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>User Id</th>
                            <th>Hotel Id</th>
                            <th>Package Id</th>
                            <th>Reviewer Name</th>
                            <th>Reviewer Email</th>
                            <th>Review Stars</th>
                            <th >Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review )
                        <tr>
                            <td>
                                {{ $review->id }}
                            </td>
                            <td>
                                {{ $review->user_id }}
                            </td>
                            <td>
                                {{ $review->hotel_id }}
                            </td>
                            <td>
                                {{ $review->package_id }}
                            </td>
                            <td>
                                {{ $review->review_name }}
                            </td>
                            <td>
                                {{ $review->review_email }}
                            </td>
                            <td>
                            @switch($review->star_review)
                                @case(5)
                                    <span class="badge rounded-pill bg-success">({{ $review->star_review }}) Excellent</span>
                                    @break
                                @case(4)
                                    <span class="badge rounded-pill bg-success">({{ $review->star_review }}) Very Good</span>
                                    @break
                                @case(3)
                                    <span class="badge rounded-pill bg-warning">({{ $review->star_review }}) Good</span>
                                    @break
                                @case(2)
                                    <span class="badge rounded-pill bg-danger">({{ $review->star_review }}) Not Good</span>
                                    @break
                                @case(1)
                                    <span class="badge rounded-pill bg-danger">({{ $review->star_review }}) Poor</span>
                                    @break
                            @endswitch
                            </td>
                            <td style="word-wrap: break-word;overflow-wrap: break-word">
                                {{ $review->message }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</main>
<!--end page main-->
@endsection


