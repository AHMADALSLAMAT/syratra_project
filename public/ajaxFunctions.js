$(document).ready(function () {
    getCountry();
    function getCountry() {
        $("#country").html("");
        $.ajax({
            url: "/get-country",
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
            url: "/get-state",
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
