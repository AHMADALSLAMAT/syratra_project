@extends('Back_End.layout.main_desgin')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">AIRLINES</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">VIEW AIRLINES</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('airlines.add') }}" class="btn btn-primary">ADD AIRLINE <i
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
                            <th>Airlines Name</th>
                            <th>Airlines Chairs</th>
                            <th>Number Of Flights</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airlines as $airline )
                        <tr>
                            <td>
                                {{ $airline->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="{{ asset( $airline->airline_logo) }}" class="rounded-circle" width="44"
                                        height="44" alt="">
                                    <div class="">
                                        <p class="mb-0">
                                            {{ $airline->airline_name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $airline->number_of_chairs }}
                            </td>
                            <td>
                              <a href=" {{route('flights.index') }}"> This airline has {{count ($airline->flights)}}   flight(s)</a>
                            </td>
                            <td>@if ($airline->airline_status == 1 )
                                <span class="badge rounded-pill bg-success">ACTIVE</span>
                                @else
                                <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleLargeModa{{ $airline->id }}" data-bs-placement="bottom"
                                        title="Views"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('airlines.edit',$airline->id) }}" class="text-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <a href="{{ route('airlines.delete',$airline->id) }}" class="text-danger"
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
@foreach ($airlines as $airline)
<div class="modal fade" id="exampleLargeModa{{ $airline->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $airline->airline_name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6> Airline Status : @if ($airline->airline_status == 1 )
                            <span class="badge rounded-pill bg-success">ACTIVE</span>
                            @else
                            <span class="badge rounded-pill bg-danger"> NOT ACTIVE</span>
                            @endif
                        </h6>
                        <hr>
                        <hr>
                        <h6> Airline Chairs :
                            {{ $airline->number_of_chairs }}
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset($airline->airline_logo) }}" alt="cover image" width="80%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page main-->
@endsection
