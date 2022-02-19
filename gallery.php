<?php require_once('templates/header.php'); ?>



<div id="display_search_info">
    <h1>  Welcome to the Gallery! </h1>
    <h2 id="display_filters"></h2>
    <h3 id="display_card_info"></h3>
</div>

<div id="filters">
    <h2> Filters: </h2>
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

    <div class="dropdown">
        <button class="dropbtn">CMC</button>
        <div class="dropdown-content">
            <!-- not a fan of mixing JavaScript inside of HTML, but this is the easiest way 
            to get value of these filter buttons that have the same id -->
            <button id="set_filter" value="cmc=1" onclick="toggle_filter(this.value)">1</button>
            <button id="set_filter" value="cmc=2" onclick="toggle_filter(this.value)">2</button>
            <button id="set_filter" value="cmc=3" onclick="toggle_filter(this.value)">3</button>
        </div>
    </div>
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