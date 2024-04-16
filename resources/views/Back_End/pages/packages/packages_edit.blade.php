@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">EDIT PACKAGES</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT PACKAGE</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('packages.update_package',$package->id) }}" method="post" enctype="multipart/form-data"
                    id="packagesadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Edit Package</h5>
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
                                                <label class="form-label">Package title</label>
                                                <input type="text" class="form-control" name="package_name"
                                                    placeholder="Product title" value="{{ $package->name }}" >
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Country</label>
                                                <select name="loca_country" id="country" class="form-control"
                                                placeholder="Location Country" required>
                                                    <option value="">
                                                        select your country
                                                    </option>
                                                </select>

                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">City</label>
                                                    <select name="loca_city" id="state" class="form-control"
                                                    placeholder="Location City" required>
                                                        <option
                                                        value="{{App\Helpers\MyFunctions::getCityName($package->loca_city,'id') }}"
                                                        @if($package->loca_city == App\Helpers\MyFunctions::getCityName($package->loca_city,'id')) selected @endif>
                                                        {{ App\Helpers\MyFunctions::getCityName($package->loca_city,'city') }}
                                                    </option>
                                                    </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Map Url</label>
                                                <input type="text" name="map_url" class="form-control"
                                                    placeholder="Map Url" value="{{ $package->map }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Package Days </label>
                                                <input type="text" name="days" class="form-control"
                                                    placeholder="Number Of Days" value="{{ $package->days }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Cover Image</label>
                                                <input class="form-control" name="cover_image" type="file" >
                                                <img src="{{ asset($package->image) }}" width="100" class="img-fluid mb-2" alt="Old Image">
                                                <input type="hidden" name="old_cover_image" value="{{ $package->image }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Summery description</label>
                                                <textarea class="form-control" name="small_text"
                                                    placeholder="Summary description" rows="4" cols="4">
                                                    {{ $package->description_small }}
                                                </textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Full description</label>
                                                <textarea class="form-control" name="full_text"
                                                    placeholder="Full description" rows="4" cols="4">
                                                    {{ $package->description_full }}
                                                </textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Itinerary</label>
                                                <div class="row gy-3">
                                                    <!-- Group of input fields -->
                                                    <div class="form-group fieldGroup">
                                                        <div class="input-group mb-3">
                                                            <input type="text"
                                                                class="form-control" placeholder="Itinerary Day"  name="itinerary_Day[]" />
                                                            <input type="text"
                                                                class="form-control" placeholder="Itinerary Title" name="itinerary_title[]" />
                                                            <textarea  class="form-control"
                                                                id="itinerary_desc" cols="3" rows="2"
                                                                placeholder="Itinerary description" name="itinerary_desc[]"></textarea>
                                                            <span class="input-group-text">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-success addMore"><i
                                                                        class="custicon plus"></i> Add</a>
                                                            </span>
                                                        </div>
                                                        @foreach ($package->itinerary_Day as $key => $item)
                                                        @if ($item != null)
                                                        <div class="form-group fieldGroupCopyEdit" >
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="old_itinerary_Day[]"
                                                                    class="form-control" placeholder="Itinerary Day" value="{{$item}}" />

                                                                    <input type="text" name="old_itinerary_title[]"
                                                                    class="form-control"
                                                                    placeholder="Itinerary Title" value="{{ $package->itinerary_title[$key]}}" />

                                                                    <textarea name="old_itinerary_desc[]" class="form-control"
                                                                    id="itinerary_desc" cols="3" rows="2"
                                                                    placeholder="Itinerary description"> {{ $package->itinerary_desc[$key]}}</textarea>
                                                                <span class="input-group-text">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-danger removeEdit"><i
                                                                        class="custicon cross"></i> Remove</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
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
                                                <input type="number"  class="form-control" min="0" name="price"
                                                    placeholder="Price" value="{{ $package->price }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Offer Price</label>
                                                <input type="number" name="offer_price" class="form-control"
                                                    placeholder="Package offer price" value="{{ $package->offer_price }}">
                                                    <small>this can be empty / the room price after decound</small>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" >
                                                    <option @if ($package->status == 1) selected @endif value="1">Published</option>
                                                    <option @if ($package->status == 0) selected @endif value="0">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Package Type</label>
                                                <select class="form-select" name="package_type" required>
                                                    <option @if ($package->package_type == 'Internal') selected @endif value="Internal">Internal</option>
                                                    <option @if ($package->package_type == 'External') selected @endif value="External">External</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label"> Package Amenities</label>
                                                <div class="form-group fieldGroupAnimate">
                                                <div class="input-group mb-3">
                                                    <input type="file"
                                                        class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" name="amenities_icon[]"/>

                                                    <input type="text"
                                                        class="form-control" placeholder="Amenities title" name="amenities_title[]" />
                                                    <span class="input-group-text">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-success addMoreAnimate"><i
                                                                class="custicon plus"></i> Add</a>
                                                    </span>
                                                </div>
                                                @foreach ($package->amenities_title as $key => $item)
                                                @if ($item != null)
                                                <div class="form-group fieldGroupCopyAnimateEdit" >
                                                    <img
                                                    src="{{ asset($package->amenities_icon[$key]) }}"
                                                     width="100" class="img-fluid mb-2" alt="Old Image"><br>
                                                     <input type="hidden" name="old_amenities_icon[]" value="{{ $package->amenities_icon[$key] }}"/>
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="old_amenities_icon[]"
                                                        class="form-control" placeholder="Amenities icon" style="font-size: 10px;
                                                        align-self: center;" />
                                                    <input type="text" name="old_amenities_title[]"
                                                        class="form-control" placeholder="Amenities title" value="{{ $item }}" />
                                                        <span class="input-group-text">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger removeAnimateEdit"><i
                                                                    class="custicon cross"></i> Remove</a>
                                                        </span>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
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
            <div class="row">
                <!-- Display old images -->
                @if ($package->gallery)
                    @foreach ($package->gallery as $index => $oldImage)
                        <div class="col-4">
                            <img src="{{ asset($oldImage) }}" class="img-fluid mb-2" alt="Old Image">
                            <input type="hidden" name="old_gallery[]" value="{{ $oldImage }}">
                            <button class="close-btn" data-index="{{ $index }}">Delete Image</button>
                        </div>
                    @endforeach
                @endif
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
        var locaCountry = "{{ $package->loca_country }}"
        $.ajax({
            url: "/dashboard/get-country/",
            type: "GET",
            success: function (data) {
                $.each(data.countries, function (key, value) {
                    $("#country").append(
                        '<option'+ (value.id == locaCountry ? ' selected ' : '') + ' value="' +
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
            url: "/dashboard/get-state/",
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
        $("body").on("click", ".removeEdit", function() {
            $(this).parents(".fieldGroupCopyEdit").remove();
        });
    });
    $(document).ready(function() {
        $("body").on("click", ".removeAnimateEdit", function() {
            $(this).parents(".fieldGroupCopyAnimateEdit").remove();
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
<script>
    var $package = @json($package);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var closeButtons = document.querySelectorAll('.close-btn');
        closeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var index = this.getAttribute('data-index');
                // Assuming old_gallery is an array, you can remove the image by its index
                $package.gallery.splice(index, 1);
                // You might need additional logic to update the UI or make an Ajax request to update the server
                // For now, let's just remove the image element from the DOM
                this.parentNode.remove();
            });
        });
    });
</script>
@stop
