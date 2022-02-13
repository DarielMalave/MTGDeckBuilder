// grab current URL of page
let current_url = window.location.href;

// initialize HTML elements that will be involved in handling and displaying
// card information from Javascript DOM manipulation
const page_display = document.getElementById('current_page_display');
const data_container = document.getElementById('card_container');
const pagination_bar = document.getElementById('pagination_bar');
const current_page = document.getElementById('current_page_counter');
// initialize variables that will be used in determining how many cards
// should be in a single page and how many total pages a search query
// will contain (rounded up to include leftover cards)
const rows_per_page = 4;

// default; load in first page of results as soon as page loads using AJAX
$.ajax({
    type: "POST",
    url: "process.php",
    data: {
        cardCountUpdated: 0,
        rowsPerPage: rows_per_page,
        string_url: current_url
    },
    success: function(response) {
        // if response is a string (i.e. an error string is returned due to
        // an error from MySQL)
        if (typeof(response) === 'string') {
            displayList(response, data_container, rows_per_page, 0);
        }

        // if response is a proper JSON object that can be displayed
        if (typeof(JSON.parse(decodeURIComponent(response))) === 'object') {
            displayList(JSON.parse(decodeURIComponent(response)), data_container, rows_per_page, 0);
        }
    }
});

// When user clicks next button, trigger AJAX event that will have client
// send a POST request to receive card information of the next page in
// search query
$("#next_button").click(function(e) {
    current_page.value++;
    page_display.innerText = current_page.value;

    let current_page_count = parseInt(document.getElementById('current_page_counter').value);
    let cardCount = (current_page_count - 1) * rows_per_page;

    $.ajax({
        type: "POST",
        url: "process.php",
        data: {
            cardCountUpdated: cardCount,
            rowsPerPage: rows_per_page,
            string_url: current_url
        },
        success: function(response) {
            let updated_data_source = JSON.parse(decodeURIComponent(response));
            console.log(updated_data_source);
            if (updated_data_source.length === 0) {
                current_page.value--;
                page_display.innerText = current_page.value;
                cardCount -= rows_per_page;
                return;
            }

            displayList(updated_data_source, data_container, rows_per_page, cardCount);
        }
    });
});

$("#previous_button").click(function(e) {
    if ((current_page.value - 1) < 1) {
        return;
    }

    current_page.value--;
    page_display.innerText = current_page.value;

    let current_page_count = parseInt(document.getElementById('current_page_counter').value);
    let cardCount = (current_page_count - 1) * rows_per_page;

    $.ajax({
        type: "POST",
        url: "process.php",
        data: {
            cardCountUpdated: cardCount,
            rowsPerPage: rows_per_page,
            string_url: current_url
        },
        success: function(response) {
            let updated_data_source = JSON.parse(decodeURIComponent(response));
            console.log(updated_data_source);
            displayList(updated_data_source, data_container, rows_per_page, cardCount);
        }
    });

});