$(document).ready(function () {
    // On page load, make an Ajax request to fetch data
    $.ajax({
        url: "/get-airport-data/",
        type: "GET",
        success: function (response) {
            // Assuming response is an array of locations
            $.each(response, function (index, location) {
                // Create option element and append it to the select
                var option = $("<option>")
                    .val(location)
                    .addClass("border-bottom border-color-1")
                    .attr(
                        "data-content",
                        '<span class="d-flex align-items-center"><span class="font-size-12">' +
                            location +
                            "</span></span>"
                    )
                    .html(location);

                $(".flight_leave_country").append(option);
            });

            // Refresh the selectpicker after updating options
            $(".flight_leave_country").selectpicker("refresh");
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
});
