<?php require_once('templates/header.php'); ?>

<!-- https://stackoverflow.com/questions/5618925/convert-php-array-to-javascript/24884659#24884659 -->
<!-- Helped me transfer PHP data to Javascript by turning PHP array into JSON file, then
printing it so that Javascript can pick up JSON file and parse it further -->

<div>
    <h2>Search: +VOW +INSTANT</h2>
    <h3>250 cards returned, 20 total pages</h3>
</div>

<div class="dropdown">
    <button class="dropbtn">Card Set</button>
    <div class="dropdown-content">
        <!-- not a fan of mixing JavaScript inside of HTML, but this is the easiest way 
    to get value of these filter buttons that have the same id -->
        <button id="set_filter" value="card_set=vow" onclick="toggle_filter(this.value)">Crimson Vow</button>
        <button id="set_filter" value="card_set=mid" onclick="toggle_filter(this.value)">Midnight Hunt</button>
        <button id="set_filter" value="card_set=strix" onclick="toggle_filter(this.value)">Strixhaven</button>
    </div>
</div>

<div>
    <span>Filter by:</span>
    <button>Card Set</button>
    <button>Colors</button>
    <button>CMC</button>
    <button>Card Type</button>
</div>

<section id="card_container"></section>
<section id="pagination_bar">
    <button id="previous_button">Previous Page</button>
    <button id="current_page_display">1</button>
    <button id="next_button">Next Page</button>
</section>

<input id="current_page_counter" type="hidden" value="1">
<input id="number_of_pages_counter" type="hidden" value="1">

<!-- <button id="current_page_display">1</button>
<button id="next_button">Next Page</button>
<button id="previous_button">Previous Page</button> -->

<script>
function displayList(data_source, wrapper, rows_per_page, page) {
    wrapper.innerHTML = "";

    if (data_source.length === 0) {
        console.log("empty object here");
    }

    if (typeof(data_source) !== 'object') {
        let error_element = document.createElement('p');
        error_element.innerText = "No results returned. Please check if query is valid.";
        wrapper.appendChild(error_element);
        return;
    }

    // account for cases where page does have cards but not up to
    // rows_per_page
    for (let i = 0; i < rows_per_page; i++) {
        let card_element = document.createElement('div');
        let card_image = document.createElement('img');
        card_image.src = data_source[i]['imageUrl'];
        card_element.appendChild(card_image);
        wrapper.appendChild(card_element);
    }
}

// This function is going to manipulate the current page's URL based on if user
// clicks on the filter buttons at the top of the search page.
// If the clicked filter is already present in URL, clicking the filter is going
// to remove the filter from URL.
// If the clicked filter is not present in URL, clicking the filter is going to 
// add the filter to the URL.
// This function will effectively act as a "toggle" function for search queries.
// This function is also going to clean up the URL after manipulation to make sure
// it looks neat and follows the pattern of "...?filter=value&filter=value&filter=value..."
function toggle_filter(filter) {
    // grab URL of page
    let string_url = window.location.href;
    // declare empty variable to hold new string_url and used as a
    // placeholder when manipulating string_url
    let updated_string_url;

    // if there are no filters in URL, that means that all filter buttons are not
    // toggled on and by default the search page is going to reveal all cards from
    // all sets
    // to apply filters, let's add a question mark at the end
    if (string_url.indexOf("?") === -1) {
        string_url += "?";
    }

    // if filter does exist in string_url, remove filter from URL
    if (string_url.indexOf(filter) > -1) {
        updated_string_url = string_url.replace(filter, "");
    }
    // otherwise, filter does not exist in string_url
    else {
        updated_string_url = string_url.concat("&" + filter);
    }

    // in case if after removal and & is the last character, remove the last &
    // (happens if last filter is removed)
    if (updated_string_url.substring(updated_string_url.length - 1) === "&") {
        updated_string_url = updated_string_url.substring(0, updated_string_url.length - 1);
    }

    if (updated_string_url.substring(updated_string_url.length - 1) === "?") {
        updated_string_url = updated_string_url.substring(0, updated_string_url.length - 1);
    }

    // fix symbols in case if ?& ever appears (happens when removing first filter)
    updated_string_url = updated_string_url.replace("?&", "?");
    // sometimes double & appear in URL, change to single &
    updated_string_url = updated_string_url.replace("&&", "&");

    // set current URL to new URL after string manipulation
    window.location.assign(updated_string_url);
}
</script>

<script>
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
//let number_of_pages = Math.ceil(40 / rows_per_page);

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
    //let current_page = document.getElementById('current_page_counter');

    //if (0 <= current_page.value && current_page.value < number_of_pages) {
    current_page.value++;
    page_display.innerText = current_page.value;
    //}

    let current_page_count = parseInt(document.getElementById('current_page_counter').value);
    let cardCount = (current_page_count - 1) * rows_per_page;
    // if (current_page_count > number_of_pages) {
    //     return;
    // }

    //e.preventDefault();
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
                // console.log("empty array here haha");
                // console.log(current_page.value);
                // console.log(cardCount);
                return;
            }

            displayList(updated_data_source, data_container, rows_per_page, cardCount);
        }
    });
});

$("#previous_button").click(function(e) {
    //let current_page = document.getElementById('current_page_counter');
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
</script>

<?php require_once('templates/footer.php'); ?>