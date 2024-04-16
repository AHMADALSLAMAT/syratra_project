@extends('Back_End.layout.main_desgin')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ADD HOTEL'S ROOMS</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">ADD NEW HOTEL'S ROOMS</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <form action="{{ route('hotels_rooms.add_post') }}" method="post" enctype="multipart/form-data"
                    id="hotelsadd">
                    @csrf
                    <div class="card-header py-3 bg-transparent">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="mb-2 mb-sm-0">Add New Hotel's Room</h5>
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
                                                <label class="form-label">HOTEL NAME</label>
                                                <select name="hotel_name" id="hotel_name" class="form-control">
                                                    <option value="0"> <--- Select the related hotel ---> </option>
                                                    @foreach ($hotels as $hotel)
                                                    <option value="{{ $hotel->id }}">{{ $hotel->hotel_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Room Level</label>
                                                <input type="text" name="room_lvl" class="form-control"
                                                    placeholder="Room Level" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label class="form-label">Room Type</label>
                                                <input type="text" name="room_type" class="form-control"
                                                    placeholder="Room Type" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Bed Type</label>
                                                <input type="text" name="room_beds" class="form-control"
                                                    placeholder="Bed Type">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Room Price / Per Night</label>
                                                <input type="number" name="room_price" class="form-control"
                                                    placeholder="Room Price of rooms">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Offer Price</label>
                                                <input type="number" name="offer_price" class="form-control"
                                                    placeholder="Room Price of rooms">
                                                    <small>this can be empty / the room price after decound</small>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Number Of Rooms</label>
                                                <input type="number" name="num_rooms" class="form-control"
                                                    placeholder="Number of rooms">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Room Image</label>
                                                <input class="form-control" name="room_image" type="file" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Room Description</label>
                                                <textarea class="form-control" name="room_description"
                                                    placeholder="Full description" rows="4" cols="4"></textarea>
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
                                                <select class="form-select" name="room_status" required>
                                                    <option value="1">Published</option>
                                                    <option value="0">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label"> Room Amenities</label>
                                                <div class="form-group fieldGroupAnimate">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="room_amenities_icon[]"
                                                        class="form-control" placeholder="Amenities icon"
                                                        style="font-size: 10px;
                                                        align-self: center;"/>
                                                    <input type="text" name="room_amenities_title[]"
                                                        class="form-control" placeholder="Amenities title" />
                                                    <span class="input-group-text">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-success addMoreAnimate"><i
                                                                class="custicon plus"></i> Add</a>
                                                    </span>
                                                </div>
                                                <!-- Replica of input field group HTML -->
                                                <div class="form-group fieldGroupCopyAnimate"
                                                style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="room_amenities_icon[]"
                                                        class="form-control" placeholder="Amenities icon"
                                                        style="font-size: 10px;
                                                        align-self: center;" />
                                                    <input type="text" name="room_amenities_title[]"
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
    let multipleUploader = new MultipleUploader('#multiple-uploader').init({
        maxUpload: 20, // maximum number of uploaded images
        maxSize: 2, // in size in mb
        filesInpName: 'room_gallery', // input name sent to backend
        formSelector: '#hotelsadd', // form selector
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
