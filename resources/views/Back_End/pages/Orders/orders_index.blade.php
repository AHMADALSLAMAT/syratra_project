@extends('Back_End.layout.main_desgin')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ORDERS</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">VIEW ORDERS</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Orders Ref</th>
                            <th>User ID</th>
                            <th>Order Type</th>
                            <th>Payment Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order )
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
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleLargeModa{{ $order->id }}" data-bs-placement="bottom"
                                        title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('orders.edit',$order->id) }}" class="text-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <a href="{{ route('orders.delete',$order->id) }}" class="text-danger"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i
                                            class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Model Popup -->
@foreach ($orders as $order)
@include('Back_End.pages.Orders.Models.invoice')
@endforeach
<!--end page main-->
@endsection
