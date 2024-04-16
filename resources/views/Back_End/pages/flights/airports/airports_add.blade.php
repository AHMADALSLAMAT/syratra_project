@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ADD AIRLINES</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ADD NEW AIRLINES</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('airlines.add_post') }}" method="post" enctype="multipart/form-data"
                    id="airlinesadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Add New Airline</h5>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-primary">Publish Now</button>
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
                                                <label class="form-label">Airport Name</label>
                                                <input type="text" class="form-control"
                                                name="airport_name"
                                                    placeholder="Airport title" >
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label class="form-label">Airport Country</label>
                                                <select name="airport_country" id="airport_country" class="form-control single-select"
                                                placeholder="Airport Country" required>
                                                    <option value=""> Select Your Country</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-12">
                                                <label class="form-label">Airport Country</label>
                                                <select name="airport_type" id="airport_type" class="form-control"
                                                placeholder="Airport Type" required>
                                                    <option value="External"> External</option>
                                                    <option value="Internal"> Internal</option>
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
                                                <select class="form-select" name="status" required>
                                                    <option value="1">Published</option>
                                                    <option value="0">Draft</option>
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
      $.ajax({
          url: "get-country",
          type: "GET",
          success: function (data) {
              $.each(data.countries, function (key, value) {
                  $("#airport_country").append(
                      '<option value="' +
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
