@php
$packagedata = \App\Models\Package::with('Country')->first();
@endphp

<div class="modal fade" id="exampleLargeModa{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   Data Of Hotel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5> Small Description</h5>
                        {{ $order->hotel_description_small }}
                        <hr>
                        <h6> hotel Status : @if ($order->hotel_status == 1 )
                            <span class="badge rounded-pill bg-success">ACTIVE</span>
                            @else
                            <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                            @endif
                        </h6>
                        <hr>
                        <hr>
                        <h6> hotel Country :
                            {{ $order->loca_country }}
                        </h6>
                        <hr>
                        <h6> hotel City :
                            {{ $order->loca_city }}
                        </h6>
                        <hr>
                        <h6 class="w-100"> Map URL : <a href="{{ $order->hotel_map }}" target="_blank"> click here</a>
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset($order->hotel_image) }}" alt="cover image" width="80%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5> Full Description</h5>
                        <hr>
                        {{ $order->hotel_description_full }}
                    </div>
                </div>
                <div class="row mb-2 mt-4">
                    <h5> Gallery Images</h5>
                    <hr>
                    @foreach ($order->hotel_gallery as $gallery)
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
                    @foreach ($order->hotel_amenities_title as $index => $amenities_title)
                    @if ($amenities_title != null )
                    <div class="col" tabindex="1">
                        <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                            <div class="font-22"> <img src="{{ asset($order->hotel_amenities_icon[$index]) }}" alt="icon"
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
