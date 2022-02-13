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

<?php require_once('templates/footer.php'); ?>