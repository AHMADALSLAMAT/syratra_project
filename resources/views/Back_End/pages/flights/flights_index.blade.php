@extends('Back_End.layout.main_desgin')
@section('content')
   <!--start content-->
   <main class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           <div class="breadcrumb-title pe-3">FLIGHTS</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">VIEW FLIGHTS</li>
                   </ol>
               </nav>
           </div>
           <div class="ms-auto">
               <div class="btn-group">
                   <a href="{{ route('flights.add') }}" class="btn btn-primary">ADD FLIGHT <i
                        class="lni lni-circle-plus"></i></a>
               </div>
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
                               <th>Airline Name</th>
                               <th>Flight Name</th>
                               <th>Flight Sku</th>
                               <th>Flight Price</th>
                               <th>Flight Return</th>
                               <th>Status</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                        @foreach ($flightsChunks as $flight)

                        <tr>
                            <td>
                                {{ $flight->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="{{ asset( $flight->airlines->airline_logo) }}" class="rounded-circle" width="44"
                                        height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">
                                            {{ $flight->airlines->airline_name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $flight->flight_name }}
                            </td>
                            <td>
                                {{ $flight->flight_sku }}
                            </td>
                            <td>
                                {{ number_format($flight->flight_price ,2) }} $
                            </td>
                            <td>
                                {{ number_format($flight->offer_price ,2) }} $
                            </td>
                             <td>
                                @if ($flight->discound > 0 )
                                <span class="badge rounded-pill bg-success">
                                    {{ $flight->discound }} %
                                </span>
                                @else
                                <span class="badge rounded-pill bg-danger"> No Discound</span>
                                @endif
                            </td>
                            <td>@if ($flight->return_flight == 1 )
                             <span class="badge rounded-pill bg-success">Has Return</span>
                             @else
                             <span class="badge rounded-pill bg-danger"> One Way</span>
                             @endif
                              </td>
                            <td>@if ($flight->flight_status == 1 )
                                <span class="badge rounded-pill bg-success">ACTIVE</span>
                                @else
                                <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleLargeModa{{ $flight->id }}"
                                        data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('flights.edit',$flight->id) }}" class="text-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="{{ route('flights.delete',$flight->id) }}"
                                      class="text-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Delete"><i
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
   @foreach ($flightsChunks as $flight)
   <div class="modal fade" id="exampleLargeModa{{ $flight->id }}" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">
                       {{ $flight->flight_name }}
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row">
                       <div class="col-md-6">
                           <h5> Airline Name</h5>
                           {{ $flight->airlines->airline_name }}
                           <hr>
                           <h6> flight Status : @if ($flight->flight_status == 1 )
                               <span class="badge rounded-pill bg-success">ACTIVE</span>
                               @else
                               <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                               @endif
                           </h6>
                           <hr>
                           <h6> flight Price :
                               {{ number_format($flight->flight_price ,2) }} AED
                           </h6>
                           <hr>
                           <h6> flight leave Country :
                               {{ $flight->flight_leave_country }}
                           </h6>

                           <h6> flight leave Airport :
                               {{ $flight->flight_leave_airport }}
                           </h6>
                           <h6> flight Leave Date :
                            {{ $flight->flight_leave_date }} / at / {{ $flight->flight_leave_hours }}
                            </h6>
                            <hr>
                            <h6> flight Arrive Country :
                                {{ $flight->flight_arrive_country }}
                            </h6>

                            <h6> flight Arrive Airport :
                                {{ $flight->flight_arrive_airport }}
                            </h6>
                            <h6> flight Arrive Date :
                             {{ $flight->flight_arrive_date }} / at / {{ $flight->flight_arrive_hours }}
                             </h6>
                           <hr>
                       </div>
                       <div class="col-md-6">
                           <img src="{{ asset($flight->airlines->airline_logo) }}" alt="cover image" width="80%">
                       </div>
                   </div>
                   <div class="row mb-2 mt-4">
                       <h5> flight Stops</h5>
                       <hr>
                       <div class="accordion" id="accordionExample">
                        @if ($flight->flight_stops == 0)
                                <h6>There is no stops (Direct Flight)</h6>
                        @else
                        @foreach ($flight->flight_stops_country as $index => $itinerary_day)
                        @if ($itinerary_day != null &&
                        $flight->flight_stops_airport[$index] != null &&
                        $flight->flight_stops_date[$index] != null )
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $index }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{ $index }}" aria-expanded="@if($index == 0)
                                 true
                             @else
                                 false
                             @endif" aria-controls="collapseOne{{ $index }}">
                             STOP {{ $index + 1 }}
                                </button>
                            </h2>
                            <div id="collapseOne{{ $index }}" class="accordion-collapse collapse @if($index == 0)
                           show
                       @endif" aria-labelledby="headingOne{{ $index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <p> Country Name :: {{ $flight->flight_stops_country[$index] }}</p>
                                    <p>Airport Name ::{{ $flight->flight_stops_airport[$index] }}</p>
                                    <p>Date :: {{ $flight->flight_stops_date[$index] }}</p>
                                    <p>Time :: {{ $flight->flight_stops_hours[$index] }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                       </div>
                   </div>
                   <hr>
                   <h5> flight Amenities</h5>
                   <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-3">
                       @foreach ($flight->flight_amenities_title as $index => $amenities_title)
                       @if ($amenities_title != null )
                       <div class="col" tabindex="1">
                           <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                               <div class="font-22"> <img src="{{ asset($flight->flight_amenities_icon[$index]) }}" alt="icon" width="30">
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
