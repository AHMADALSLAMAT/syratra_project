@extends('Back_End.layout.main_desgin')
@section('content')
   <!--start content-->
   <main class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           <div class="breadcrumb-title pe-3">PACKAGES</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">VIEW PACKAGES</li>
                   </ol>
               </nav>
           </div>
           <div class="ms-auto">
               <div class="btn-group">
                   <a href="{{ route('packages.add') }}" class="btn btn-primary">ADD PACKAGE <i
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
                               <th>Package title</th>
                               <th>Country</th>
                               <th>City</th>
                               <th>Price</th>
                               <th>Offer Price</th>
                               <th>Discound</th>
                               <th>Days</th>
                               <th>Status</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($packages as $package )
                           <tr>
                               <td>
                                   {{ $package->id }}
                               </td>
                               <td>
                                   <div class="d-flex align-items-center gap-3 cursor-pointer">
                                       <img src="{{ asset( $package->image) }}" class="rounded-circle" width="44"
                                           height="44" alt="">
                                       <div class="">
                                           <p class="mb-0">
                                               {{ $package->name }}
                                           </p>
                                       </div>
                                   </div>
                               </td>
                               <td>
                                   {{ \App\Models\Country::where('id',$package->loca_country)->value('country') }}
                               </td>
                               <td>
                                {{ \App\Models\City::where('id',$package->loca_city)->value('city') }}
                               </td>
                               <td>
                                   {{ number_format($package->price ,2) }} $
                               </td>
                               <td>
                                {{ number_format($package->offer_price,2) }} $
                            </td>
                            <td>
                                @if ($package->discound > 0 )
                                <span class="badge rounded-pill bg-success">
                                    {{ $package->discound }} %
                                </span>
                                @else
                                <span class="badge rounded-pill bg-danger"> No Discound</span>
                                @endif
                            </td>
                               <td>
                                {{$package->days }}
                               </td>
                               <td>@if ($package->status == 1 )
                                   <span class="badge rounded-pill bg-success">ACTIVE</span>
                                   @else
                                   <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                                   @endif
                               </td>
                               <td>
                                   <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                       <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                           data-bs-target="#exampleLargeModa{{ $package->id }}"
                                           data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                       <a href="{{ route('packages.edit',$package->id) }}" class="text-warning" data-bs-toggle="tooltip"
                                           data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                       <a href="{{ route('packages.delete',$package->id) }}"
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
@foreach ($packages as $package)
   <div class="modal fade" id="exampleLargeModa{{ $package->id }}" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">
                       {{ $package->name }}
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row">
                       <div class="col-md-6">
                           <h5> Small Description</h5>
                           {{ $package->description_small }}
                           <hr>
                           <h6> Package Status : @if ($package->status == 1 )
                               <span class="badge rounded-pill bg-success">ACTIVE</span>
                               @else
                               <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                               @endif
                           </h6>
                           <hr>
                           <h6> Package Price :
                               {{ number_format($package->price ,2) }} AED
                           </h6>
                           <hr>
                           <h6> Package Country :
                               {{ $package->loca_country }}
                           </h6>
                           <hr>
                           <h6> Package City :
                               {{ $package->loca_city }}
                           </h6>
                           <hr>
                           <h6 class="w-100"> Map URL : <a href="{{ $package->map }}" target="_blank"> click here</a>
                           </h6>
                           <hr>
                       </div>
                       <div class="col-md-6">
                           <img src="{{ asset($package->image) }}" alt="cover image" width="80%">
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12">
                           <h5> Full Description</h5>
                           <hr>
                           {{ $package->description_full }}
                       </div>
                   </div>
                   <div class="row mb-2 mt-4">
                       <h5> Gallery Images</h5>
                       <hr>
                       @foreach ($package->gallery as $gallery)
                       <div class="col-md-2">
                           <img src="{{ asset($gallery) }}" alt="gallery image" width="100%">
                       </div>
                       @endforeach
                   </div>
                   <div class="row mb-2 mt-4">
                       <h5> Package Itinerary</h5>
                       <hr>
                       <div class="accordion" id="accordionExample">
                           @foreach ($package->itinerary_Day as $index => $itinerary_day)
                           @if ($itinerary_day != null && $package->itinerary_title[$index] != null && $package->itinerary_desc[$index] != null )
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
                                       <h6>{{ $package->itinerary_title[$index] }}</h6>
                                       <p>{{ $package->itinerary_desc[$index] }}</p>
                                   </div>
                               </div>
                           </div>
                           @endif
                           @endforeach
                       </div>
                   </div>
                   <hr>
                   <h5> Package Amenities</h5>
                   <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-3">
                       @foreach ($package->amenities_title as $index => $amenities_title)
                       @if ($amenities_title != null )
                       <div class="col" tabindex="1">
                           <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                               <div class="font-22"> <img src="{{ asset($package->amenities_icon[$index]) }}" alt="icon" width="30">
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
