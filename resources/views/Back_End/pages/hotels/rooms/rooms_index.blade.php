@extends('Back_End.layout.main_desgin')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">HOTEL'S ROOMS</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $hotel->hotel_name }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add_more_hotel_room.add',$hotel->id) }}"
                    class="btn btn-primary">ADD MORE ROOMS <i
                    class="lni lni-circle-plus"></i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example"
                class="table table-striped table-bordered"
                style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>HOTELS Name</th>
                            <th>Room Price</th>
                            <th>offer Price</th>
                            <th>Discound</th>
                            <th>Room Beds</th>
                            <th>Number Of Rooms</th>
                            <th>Room Level</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotel->Rooms as $room )
                        <tr>
                            <td>
                                {{ $room->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="{{ asset( $room->room_image) }}" class="rounded-circle" width="44" height="44"
                                        alt="">
                                    <div class="">
                                        <p class="mb-0">
                                            {{ $hotel->hotel_name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ number_format($room->room_price,2) }}$
                            </td>
                            <td>
                                {{ number_format($room->offer_price,2) }} $
                            </td>
                            <td>
                                @if ($room->discound > 0 )
                                <span class="badge rounded-pill bg-success">
                                    {{ $room->discound }} %
                                </span>
                                @else
                                <span class="badge rounded-pill bg-danger"> No Discound</span>
                                @endif
                            </td>
                            <td>
                                {{ $room->room_beds }}
                            </td>
                            <td>
                                {{ $room->num_of_rooms }}
                            </td>
                            <td>
                                {{ $room->room_lvl }}
                            </td>
                            <td>
                                {{ $room->room_type }}
                            </td>
                            <td>@if ($room->room_status == 1 )
                                <span class="badge rounded-pill bg-success">ACTIVE</span>
                                @else
                                <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleLargeModa{{ $room->id }}" data-bs-placement="bottom"
                                        title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('hotels_rooms.edit',$room->id) }}" class="text-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <a href="{{ route('hotels_rooms.delete',$room->id) }}" class="text-danger"
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
@foreach ($hotel->Rooms as $room )
<div class="modal fade" id="exampleLargeModa{{ $room->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $hotel->hotel_name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5> Description</h5>
                        {{ $room->room_description }}
                        <hr>
                        <h6> hotel Status : @if ($room->room_status == 1 )
                            <span class="badge rounded-pill bg-success">ACTIVE</span>
                            @else
                            <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                            @endif
                        </h6>
                        <hr>
                        <hr>
                        <h6> Room Price :
                            {{ $room->room_price }} AED
                        </h6>
                        <p>
                            Offer Price :  {{ $room->offer_price }}
                        </p>
                        <p>
                            @if ($room->discound > 0 )
                            <span class="badge rounded-pill bg-success">
                                Discound Price :   {{ $room->discound }} %
                            </span>
                            @else
                            <span class="badge rounded-pill bg-danger"> No Discound</span>
                            @endif
                        </p>
                        <hr>
                        <h6> Room Beds :
                            {{ $room->room_beds }}
                        </h6>
                        <h6> Room Level :
                            {{ $room->room_lvl }}
                        </h6>
                        <h6> Room Type :
                            {{ $room->room_type }}
                        </h6>
                        <hr>
                        <h6 class="w-100">Number Of Rooms : {{ $room->num_of_rooms }}
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset($room->room_image) }}" alt="cover image" width="80%">
                    </div>
                </div>
                <div class="row mb-2 mt-4">
                    <h5> Gallery Images</h5>
                    <hr>
                    @foreach ($room->room_gallery as $gallery)
                    <div class="col-md-2">
                        <img src="{{ asset($gallery) }}" alt="gallery image" width="100%">
                    </div>
                    @endforeach
                </div>
                <div class="row mb-2 mt-4">
                    <h5> hotel Itinerary</h5>
                    <hr>
                </div>
                <hr>
                <h5> hotel Amenities</h5>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-3">
                    @foreach ($room->room_amenities_title as $index => $amenities_title)
                    @if ($amenities_title != null )
                    <div class="col" tabindex="1">
                        <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                            <div class="font-22"> <img src="{{ asset($room->room_amenities_icon[$index]) }}" alt="icon"
                                    width="30">
                            </div>
                            <div class="ms-2">{{ $amenities_title }}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page main-->
@endsection
