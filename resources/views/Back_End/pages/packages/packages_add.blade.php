@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ADD PACKAGES</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ADD NEW PACKAGE</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('packages.add_post') }}" method="post" enctype="multipart/form-data"
                    id="packagesadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Add New Package</h5>
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
                                                <label class="form-label">Package title</label>
                                                <input type="text" class="form-control" name="package_name"
                                                    placeholder="Product title" >
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Country</label>
                                                <select name="loca_country" id="country" class="form-control"
                                                placeholder="Location Country" required>
                                                    <option value=""> Select Your Country</option>
                                                </select>

                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">City</label>
                                                    <select name="loca_city" id="state" class="form-control"
                                                    placeholder="Location City" required>
                                                        <option value=""> Select Your State</option>
                                                    </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Package Days </label>
                                                <input type="text" name="days" class="form-control"
                                                    placeholder="Number Of Days">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Map Url</label>
                                                <input type="text" name="map_url" class="form-control"
                                                    placeholder="Map Url">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Cover Image</label>
                                                <input class="form-control" name="cover_image" type="file" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Summery description</label>
                                                <textarea class="form-control" name="small_text"
                                                    placeholder="Summary description" rows="4" cols="4"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Full description</label>
                                                <textarea class="form-control" name="full_text"
                                                    placeholder="Full description" rows="4" cols="4"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Itinerary</label>
                                                <div class="row gy-3">
                                                    <!-- Group of input fields -->
                                                    <div class="form-group fieldGroup">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="itinerary_Day[]"
                                                                class="form-control" placeholder="Itinerary Day" />
                                                            <input type="text" name="itinerary_title[]"
                                                                class="form-control" placeholder="Itinerary Title" />
                                                            <textarea name="itinerary_desc[]" class="form-control"
                                                                id="itinerary_desc" cols="3" rows="2"
                                                                placeholder="Itinerary description"></textarea>
                                                            <span class="input-group-text">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-success addMore"><i
                                                                        class="custicon plus"></i> Add</a>
                                                            </span>
                                                        </div>
                                                        <!-- Replica of input field group HTML -->
                                                        <div class="form-group fieldGroupCopy" style="display: none;">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="itinerary_Day[]"
                                                                    class="form-control" placeholder="Itinerary Day" />
                                                                <input type="text" name="itinerary_title[]"
                                                                    class="form-control"
                                                                    placeholder="Itinerary Title" />
                                                                <textarea name="itinerary_desc[]" class="form-control"
                                                                    id="itinerary_desc" cols="3" rows="2"
                                                                    placeholder="Itinerary description"></textarea>
                                                                <span class="input-group-text">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-danger remove"><i
                                                                        class="custicon cross"></i> Remove</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <label class="form-label">Price</label>
                                                <input type="number" required class="form-control" min="0" name="price"
                                                    placeholder="Price">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Offer Price</label>
                                                <input type="number" name="offer_price" class="form-control"
                                                    placeholder="Package Offer Price">
                                                    <small>this can be empty / the room price after decound</small>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <option value="1">Published</option>
                                                    <option value="0">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Package Type</label>
                                                <select class="form-select" name="package_type" required>
                                                    <option value="Internal">Internal</option>
                                                    <option value="External">External</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label"> Package Amenities</label>
                                                <div class="form-group fieldGroupAnimate">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="amenities_icon[]"
                                                        class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;"/>
                                                    <input type="text" name="amenities_title[]"
                                                        class="form-control" placeholder="Amenities title" />
                                                    <span class="input-group-text">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-success addMoreAnimate"><i
                                                                class="custicon plus"></i> Add</a>
                                                    </span>
                                                </div>
                                                <!-- Replica of input field group HTML -->
                                                <div class="form-group fieldGroupCopyAnimate" style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="amenities_icon[]"
                                                        class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" />
                                                    <input type="text" name="amenities_title[]"
                                                        class="form-control" placeholder="Amenities title" />
                                                        <span class="input-group-text">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger removeAnimate"><i
                                                                    class="custicon cross"></i> Remove</a>
                                                        </span>
                                                    </div>
                                                </div>
                                                </div>
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
            <div class="multiple-uploader" id="multiple-uploader" style="z-index: 10">
                <div class="mup-msg">
                    <span class="mup-main-msg">click to upload gallery Images.</span>
                    <span class="mup-msg" id="max-upload-number">Upload up to 20 images</span>
                    <span class="mup-msg" id="max-size">MAX SIZE OF EACH IMAGE up to 2 MB</span>
                    <span class="mup-msg">Only images are allowed for upload</span>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

</main>
@endsection
@section('js')
<script>
    $(document).ready(function () {
    getCountry();
    function getCountry() {
        $("#country").html("");
        $.ajax({
            url: "get-country",
            type: "GET",
            success: function (data) {
                $.each(data.countries, function (key, value) {
                    $("#country").append(
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

    $("#country").on("change", function () {
        var country_id = this.value;
        $("#state").html("");
        $.ajax({
            url: "get-state",
            type: "POST",
            data: {
                country_id: country_id,
                " _token": $("[name=csrf-token]").attr("content"),
            },
            dataType: "json",
            success: function (result) {
                $.each(result.cities, function (key, value) {
                    $("#state").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.city +
                            "</option>"
                    );
                });
                $("#city").html('<option value="">Select State First</option>');
            },
        });
    });
});
</script>
<script>
    let multipleUploader = new MultipleUploader('#multiple-uploader').init({
        maxUpload: 20, // maximum number of uploaded images
        maxSize: 2, // in size in mb
        filesInpName: 'package_add_gallery', // input name sent to backend
        formSelector: '#packagesadd', // form selector
    });
</script>
<script>
    $(document).ready(function() {
        // Maximum number of groups can be added
        var maxGroup = 10;
        // Add more group of input fields
        $(".addMore").click(function() {
            if ($('body').find('.fieldGroup').length < maxGroup) {
                var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                    '</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });
        // Remove fields group
        $("body").on("click", ".remove", function() {
            $(this).parents(".fieldGroup").remove();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Maximum number of groups can be added
        var maxGroup = 20;
        // Add more group of input fields
        $(".addMoreAnimate").click(function() {
            if ($('body').find('.fieldGroupAnimate').length < maxGroup) {
                var fieldHTML = '<div class="form-group fieldGroupAnimate">' + $(".fieldGroupCopyAnimate").html() +
                    '</div>';
                $('body').find('.fieldGroupAnimate:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });
        // Remove fields group
        $("body").on("click", ".removeAnimate", function() {
            $(this).parents(".fieldGroupAnimate").remove();
        });
    });
</script>
@stop
