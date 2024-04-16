@php
$packagedata = \App\Models\Package::with('Country')->first();
@endphp
<div class="modal fade" id="exampleLargeModa{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $packagedata->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5> Small Description</h5>
                        {{ $packagedata->description_small }}
                        <hr>
                        <h6> packagedata Status : @if ($packagedata->status == 1 )
                            <span class="badge rounded-pill bg-success">ACTIVE</span>
                            @else
                            <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                            @endif
                        </h6>
                        <hr>
                        <h6> packagedata Price :
                            {{ number_format($packagedata->price ,2) }} AED
                        </h6>
                        <hr>
                        <h6> packagedata Country :
                            {{ $packagedata->loca_country }}
                        </h6>
                        <hr>
                        <h6> packagedata City :
                            {{ $packagedata->loca_city }}
                        </h6>
                        <hr>
                        <h6 class="w-100"> Map URL : <a href="{{ $packagedata->map }}" target="_blank"> click here</a>
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset($packagedata->image) }}" alt="cover image" width="80%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5> Full Description</h5>
                        <hr>
                        {{ $packagedata->description_full }}
                    </div>
                </div>
                <div class="row mb-2 mt-4">
                    <h5> Gallery Images</h5>
                    <hr>
                    @foreach ($packagedata->gallery as $gallery)
                    <div class="col-md-2">
                        <img src="{{ asset($gallery) }}" alt="gallery image" width="100%">
                    </div>
                    @endforeach
                </div>
                <div class="row mb-2 mt-4">
                    <h5> packagedata Itinerary</h5>
                    <hr>
                    <div class="accordion" id="accordionExample">
                        @foreach ($packagedata->itinerary_Day as $index => $itinerary_day)
                        @if ($itinerary_day != null && $packagedata->itinerary_title[$index] != null && $packagedata->itinerary_desc[$index] != null )
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $index }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{ $index }}" aria-expanded="@if($index == 0)
                                 true
                             @else
                                 false
                             @endif" aria-controls="collapseOne{{ $index }}">
                                    {{ $itinerary_day }}
                                </button>
                            </h2>
                            <div id="collapseOne{{ $index }}" class="accordion-collapse collapse @if($index == 0)
                           show
                       @endif" aria-labelledby="headingOne{{ $index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h6>{{ $packagedata->itinerary_title[$index] }}</h6>
                                    <p>{{ $packagedata->itinerary_desc[$index] }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <hr>
                <h5> packagedata Amenities</h5>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-3">
                    @foreach ($packagedata->amenities_title as $index => $amenities_title)
                    @if ($amenities_title != null )
                    <div class="col" tabindex="1">
                        <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                            <div class="font-22"> <img src="{{ asset($packagedata->amenities_icon[$index]) }}" alt="icon" width="30">
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
