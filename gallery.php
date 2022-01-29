<?php require_once('templates/header.php'); ?>

<!-- https://stackoverflow.com/questions/5618925/convert-php-array-to-javascript/24884659#24884659 -->
<!-- Helped me transfer PHP data to Javascript by turning PHP array into JSON file, then
printing it so that Javascript can pick up JSON file and parse it further -->

<script>
    $(document).ready(function() {
        // use GET request to add filters to search results
        <?php echo "const current_url = \"" . $_SERVER['REQUEST_URI'] . "\";"; ?>

        // initialize HTML elements that will be involved in handling and displaying
        // card information from Javascript DOM manipulation
        const page_display = document.getElementById('current_page_display');
        const data_container = document.getElementById('card_container');
        const pagination_bar = document.getElementById('pagination_bar');
        // initialize variables that will be used in determining how many cards
        // should be in a single page and how many total pages a search query
        // will contain (rounded up to include leftover cards)
        const rows_per_page = 4;
        let number_of_pages = Math.ceil(40 / rows_per_page);

        // default; load in first page of results as soon as page loads using
        // AJAX
        $.ajax({
            type: "POST",
            url: "process.php",
            data: {cardCountUpdated: 0, rowsPerPage: rows_per_page, string_url: current_url},
            success: function(response) {
                let updated_data_source = JSON.parse(decodeURIComponent(response));
                displayList(updated_data_source, data_container, rows_per_page, 0);
                //document.getElementById('number_of_pages_counter').value = Math.ceil(updated_data_source[updated_data_source.length - 1] / rows_per_page);
            }
        });

        // When user clicks next button, trigger AJAX event that will have client
        // send a POST request to receive card information of the next page in
        // search query
        $("#next_button").click(function(e) {
            // this is used to update the display that shows what current page
            // user is in right now
            let current_page = document.getElementById('current_page_counter');
            //let number_of_pages = document.getElementById('number_of_pages_counter').value;
            //let number_of_pages = document.getElementById('number_of_pages_counter');
            //console.log(number_of_pages);
            if (0 <= current_page.value && current_page.value < number_of_pages) {
                current_page.value ++;
                page_display.innerText = current_page.value;
            }

            let current_page_count = parseInt(document.getElementById('current_page_counter').value);
            let cardCount = (current_page_count - 1) * rows_per_page;
            if (current_page_count > number_of_pages) {
                return;
            }

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "process.php",
                data: {cardCountUpdated: cardCount, rowsPerPage: rows_per_page, string_url: current_url},
                success: function(response) {
                    let updated_data_source = JSON.parse(decodeURIComponent(response));
                    displayList(updated_data_source, data_container, rows_per_page, cardCount);
                }
            });
        });

        $("#previous_button").click(function(e) {
            let current_page = document.getElementById('current_page_counter');
            //let number_of_pages = document.getElementById('number_of_pages_counter');
            // this conditional is to make sure paginated results do not go out of bounds
            if (1 < current_page.value && current_page.value <= number_of_pages) {
                current_page.value --;
                page_display.innerText = current_page.value;
            }

            let current_page_count = parseInt(document.getElementById('current_page_counter').value);
            let cardCount = (current_page_count - 1) * rows_per_page;
            if (current_page_count < 1) {
                return;
            }
            
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "process.php",
                data: {cardCountUpdated: cardCount, rowsPerPage: rows_per_page, string_url: current_url},
                success: function(response) {
                    let updated_data_source = JSON.parse(decodeURIComponent(response));
                    displayList(updated_data_source, data_container, rows_per_page, cardCount);
                }
            });
        });
    });
</script>

<div>
    <h2>Search: +VOW +INSTANT</h2>
    <h3>250 cards returned, 20 total pages</h3>
</div>

<div class="dropdown">
  <button class="dropbtn">Card Set</button>
  <div class="dropdown-content">
    <a href="<?php echo (strpos($_SERVER['REQUEST_URI'], "?") === false) ? "" . $_SERVER['REQUEST_URI'] . "?card_set=mid" : "" . $_SERVER['REQUEST_URI'] . "&card_set=mid"; ?>">Crimson Vow</a>
    <a href="<?php echo $_SERVER['REQUEST_URI'] . "?card_set=mid"; ?>">Midnight Hunt</a>
    <a href="#">Strixhaven</a>
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
<!-- <input id="number_of_pages_counter" type="hidden" value="1"> -->

<!-- <button id="current_page_display">1</button>
<button id="next_button">Next Page</button>
<button id="previous_button">Previous Page</button> -->

<script>
    function displayList(data_source, wrapper, rows_per_page, page) {
        wrapper.innerHTML = "";
        for (let i = 0; i < rows_per_page; i++) {
            let card_element = document.createElement('div');
            let card_image = document.createElement('img');
            card_image.src = data_source[i]['imageUrl'];
            card_element.appendChild(card_image);
            wrapper.appendChild(card_element);
        }
    }
</script>

<?php require_once('templates/footer.php'); ?>