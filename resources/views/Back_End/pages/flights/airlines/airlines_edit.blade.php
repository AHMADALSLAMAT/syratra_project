@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">EDIT AIRLINE</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT AIRLINE</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form
                    action="{{ route('airlines.update_airline',$airline->id) }}"
                    method="post" enctype="multipart/form-data"
                    id="airlinesadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit {{ $airline->airline_name }}</h5>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary">Upldated Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-8">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Airline title</label>
                                                <input type="text" class="form-control" name="airline_name"
                                                    placeholder="Airline title" value="{{ $airline->airline_name }}" >
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Airline Chairs</label>
                                                <input type="text" name="number_of_chairs" class="form-control"
                                                    placeholder="Airline Chairs"  value="{{ $airline->number_of_chairs }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Airline Logo</label>
                                                <input class="form-control" name="airline_logo" type="file" >
                                                <img src="{{ asset($airline->airline_logo) }}"
                                                width="100" class="img-fluid mb-2" alt="Old Image">
                                                <input type="hidden" name="old_airline_logo" value="{{ $airline->airline_logo }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card shadow-none bg-light border">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="airline_status" >
                                                    <option @if ($airline->airline_status == 1) selected @endif value="1">Published</option>
                                                    <option @if ($airline->airline_status == 0) selected @endif value="0">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
            </div>
        </form>
        </div>
    </div>
    <!--end row-->
</main>
@endsection
@section('js')

@stop
