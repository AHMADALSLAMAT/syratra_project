@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">EDIT airport</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT airport</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form
                    action="{{ route('airports.update_airport',$airport->id) }}"
                    method="post" enctype="multipart/form-data"
                    id="airportsadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit {{ $airport->airport_name }}</h5>
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
                                                <label class="form-label">airport title</label>
                                                <input type="text" class="form-control"
                                                name="airport_name"
                                                    placeholder="airport title" value="
                                                    {{ $airport->airport_name }}" >
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Airport Code</label>
                                                <input type="text" name="airport_code" class="form-control"
                                                    placeholder="airport Chairs"
                                                    value="{{ $airport->airport_code }}">
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label class="form-label">Airport Country</label>
                                                <select name="airport_country" id="airport_country" class="form-control"
                                                placeholder="Airport Country" required>
                                                    <option value=""> Select Your Country</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label class="form-label">Airport Country</label>
                                                <select name="airport_type" id="airport_type" class="form-control"
                                                placeholder="Airport Type" required>
                                                    <option value="External"
                                                    @if($$airport->airport_type =='External')
                                                        selected
                                                    @endif> External</option>
                                                    <option value="Internal"
                                                    @if($$airport->airport_type =='Internal')
                                                    selected
                                                @endif> Internal</option>
                                                </select>
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
                                                <select class="form-select" name="status" >
                                                    <option @if ($airport->status == 1) selected @endif value="1">Published</option>
                                                    <option @if ($airport->status == 0) selected @endif value="0">Draft</option>
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
<script>
    $(document).ready(function () {
      getLeaveCountry();
  function getLeaveCountry() {
      $("#airport_country").html("");
     var leaveContry = "{{ $airport->airport_country }}"
      $.ajax({
          url: "/dashboard/get-country/",
          type: "GET",
          success: function (data) {
              $.each(data.countries, function (key, value) {
                  $("#airport_country").append(

                      '<option'+ (value.id == leaveContry ? ' selected ' : '') + ' value="' +
                            value.id +
                            '">' +
                            value.country +
                            "</option>"
                  );
              });
          },
      });
  }
});
</script>
@endsection
