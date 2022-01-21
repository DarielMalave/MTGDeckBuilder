<?php require_once('templates/header.php'); ?>

<script>
    $(document).ready(function() {
        let page_display = document.getElementById('current_page_display');
        let number_of_pages = Math.ceil(20 / rows_per_page);

        // default; load in first page of results
        $.ajax({
            type: "POST",
            url: "process.php",
            data: {cardCountUpdated: 0},
            success: function(response) {
                let updated_data_source = JSON.parse(decodeURIComponent(response));
                displayList(updated_data_source, data_container, rows_per_page, 0);
            }
        });

        $("#next_button").click(function(e) {
            let current_page = document.getElementById('current_page_counter');
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
                    data: {cardCountUpdated: cardCount},
                    success: function(response) {
                        let updated_data_source = JSON.parse(decodeURIComponent(response));
                        displayList(updated_data_source, data_container, rows_per_page, cardCount);
                    }
                });
        });

        $("#previous_button").click(function(e) {
            let current_page = document.getElementById('current_page_counter');
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
                data: {cardCountUpdated: cardCount},
                success: function(response) {
                    let updated_data_source = JSON.parse(decodeURIComponent(response));
                    displayList(updated_data_source, data_container, rows_per_page, cardCount);
                }
            });
        });
    });
</script>

<section id="card_container"></section>
<section id="pagination_bar"></section>
<input id="current_page_counter" type="hidden" value="1">
<button id="current_page_display">1</button>
<button id="next_button">Next Page</button>
<button id="previous_button">Previous Page</button>

<button id="updateButton">Show more!</button>

<script>
    const data_container = document.getElementById('card_container');
    const pagination_bar = document.getElementById('pagination_bar');

    let current_page = 1;
    let rows_per_page = 4;

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