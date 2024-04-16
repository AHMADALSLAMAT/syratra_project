// LEAVE CITY OR AIRPOT

$(document).ready(function () {
    // Add an event listener for the input field
    $(".getCityName").on("keyup", function (e) {
        // Get the entered value
        var keywordData = $(".bs-searchbox input").val();
        console.log(keywordData);
        // Make sure the keyword is not empty
        if (keywordData.length > 0) {
            // Construct the full API URL with the keyword
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            // Make an AJAX call to the Amadeus API
            $.ajax({
                url: "/api/getAirportOrCity",
                method: "post",
                data: {
                    keyword: keywordData,
                },
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // Assuming the response is an array of results
                    var results = response.data;
                    // Handle the response, e.g., update dropdown options
                    updateDropdownOptions(results);
                },
                error: function (error) {
                    console.error(
                        "Error fetching data from Amadeus API:",
                        error
                    );
                },
            });
        }
    });
});
// Function to update dropdown options based on the API response
function updateDropdownOptions(data) {
    var dropdown = $("#getCityName");

    // Clear existing options
    dropdown.empty();

    // Loop through the data and append new options
    data.forEach(function (item) {
        var option = $("<option>", {
            class: "border-bottom border-color-1 city",
            "data-content":
                '<span class="d-flex align-items-center"><span class="font-size-12">' +
                item.address.cityName +
                "( " +
                item.address.countryName +
                " ) </span></span>",
            value: item.address.cityCode, // Set the value based on your API response
            text:
                item.address.cityName + "( " + item.address.countryName + " )", // Set the text based on your API response
        });
        // Append the option to the dropdown
        dropdown.append(option);
    });

    // Refresh the Bootstrap SelectPicker
    dropdown.selectpicker("refresh");
}

//Arrive CITY OR AIRPORT
$(document).ready(function () {
    // Add an event listener for the input field
    $(".arrivecountry").on("keyup", function (e) {
        // Get the entered value
        var keywordDataarrive = $(".arrivecountry .bs-searchbox input").val();

        // Make sure the keyword is not empty
        if (keywordDataarrive.length > 0) {
            // Construct the full API URL with the keyword
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            // Make an AJAX call to the Amadeus API
            $.ajax({
                url: "/api/getAirportOrCity",
                method: "post",
                data: {
                    keyword: keywordDataarrive,
                },
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // Assuming the response is an array of results
                    var results = response.data;
                    // Handle the response, e.g., update dropdown options
                    updateDropdownOptionsarrive(results);
                },
                error: function (error) {
                    console.error(
                        "Error fetching data from Amadeus API:",
                        error
                    );
                },
            });
        }
    });
});
// Function to update dropdown options based on the API response
function updateDropdownOptionsarrive(data) {
    var dropdown = $("#arrivecountry");
    // Clear existing options
    dropdown.empty();
    // Loop through the data and append new options
    data.forEach(function (item) {
        var option = $("<option>", {
            class: "border-bottom border-color-1 city",
            "data-content":
                '<span class="d-flex align-items-center"><span class="font-size-12">' +
                item.address.cityName +
                "( " +
                item.address.countryName +
                " ) </span></span>",
            value: item.address.cityCode, // Set the value based on your API response
            text:
                item.address.cityName + "( " + item.address.countryName + " )", // Set the text based on your API response
        });
        // Append the option to the dropdown
        dropdown.append(option);
    });

    // Refresh the Bootstrap SelectPicker
    dropdown.selectpicker("refresh");
}
