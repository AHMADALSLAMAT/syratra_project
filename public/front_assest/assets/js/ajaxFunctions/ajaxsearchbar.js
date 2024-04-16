// update the guests and rooms value based on the input
$(document).ready(function () {
    $("#update_guests").click(function (e) {
        e.preventDefault();
        var rooms_number = $("#number_of_rooms").val();
        var rooms_guests = $("#number_of_gusts").val();
        $("#total_guests").html(
            rooms_number + " Rooms - " + rooms_guests + " Guests"
        );
    });
});

// update the days value based on the input
$(document).ready(function () {
    $("#update_days").click(function (e) {
        e.preventDefault();
        var rooms_number = $("#days").val();
        $("#total_days").html(rooms_number + " Days");
    });
});

$(document).ready(function () {
    $('button[data-submit="searchnow"]').click(function (e) {
        e.preventDefault();
        // Get the form ID associated with the clicked button
        var formId = $(this).closest("form").attr("id");
        // Make an Ajax request to the specified route
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: "/search/" + formId,
            type: "POST", // or 'GET' based on your route definition
            data: $("#" + formId).serialize(),
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // Check the status and perform actions accordingly
                if (response.status == "success") {
                    // Do something on success, for example, redirect to a new page
                    window.location.href =
                        "/searchdata?searchName=" +
                        formId +
                        "&&data=" +
                        encodeURIComponent(
                            JSON.stringify($("#" + formId).serialize())
                        );
                } else {
                    alert(response.message);
                    console.log(response.status);
                }
            },
            error: function (error) {
                // Handle the error
                console.error(error);
            },
        });
    });
});
