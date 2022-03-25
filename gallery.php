<?php 
require_once('templates/gallery_header.php'); 
require_once('templates/modal_template.php');
?>

<div id="display_search_info">
    <h1> Welcome to the Gallery! </h1>
    <h2 id="display_filters"></h2>
    <h3 id="display_card_info"></h3>
</div>

<div id="filters">
    <h2> Filters: </h2>
    <div class="dropdown">
        <button class="dropbtn">Card Set</button>
        <div class="dropdown-content">
            <!-- not a fan of mixing JavaScript inside of HTML, but this is the easiest way 
            to get individual value of these filter buttons that have the same id -->
            <button name="filter" value="card_set=vow" name="card_set=vow" onclick="toggle_filter(this.value)">Crimson
                Vow</button>
            <button name="filter" value="card_set=mid" onclick="toggle_filter(this.value)">Midnight Hunt</button>
            <button name="filter" value="card_set=afr" onclick="toggle_filter(this.value)">Adventures in the Forgotten
                Realms</button>
            <button name="filter" value="card_set=stx" onclick="toggle_filter(this.value)">Strixhaven: School of
                Mages</button>
            <button name="filter" value="card_set=khm" onclick="toggle_filter(this.value)">Kaldheim</button>
            <button name="filter" value="card_set=znr" onclick="toggle_filter(this.value)">Zendikar Rising</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">CMC</button>
        <div class="dropdown-content">
            <button name="filter" value="cmc=1" onclick="toggle_filter(this.value)">1</button>
            <button name="filter" value="cmc=2" onclick="toggle_filter(this.value)">2</button>
            <button name="filter" value="cmc=3" onclick="toggle_filter(this.value)">3</button>
            <button name="filter" value="cmc=4" onclick="toggle_filter(this.value)">4</button>
            <button name="filter" value="cmc=5" onclick="toggle_filter(this.value)">5</button>
            <button name="filter" value="cmc=6" onclick="toggle_filter(this.value)">6</button>
            <button name="filter" value="cmc=7" onclick="toggle_filter(this.value)">7</button>
            <button name="filter" value="cmc=8" onclick="toggle_filter(this.value)">8</button>
            <button name="filter" value="cmc=9" onclick="toggle_filter(this.value)">9</button>
            <!-- add 12 CMC filter? -->
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Color Identity</button>
        <div class="dropdown-content">
            <button name="filter" value="manaCost={R}" onclick="toggle_filter(this.value)">Red</button>
            <button name="filter" value="manaCost={U}" onclick="toggle_filter(this.value)">Blue</button>
            <button name="filter" value="manaCost={G}" onclick="toggle_filter(this.value)">Green</button>
            <button name="filter" value="manaCost={W}" onclick="toggle_filter(this.value)">White</button>
            <button name="filter" value="manaCost={B}" onclick="toggle_filter(this.value)">Black</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Type</button>
        <div class="dropdown-content">
            <button name="filter" value="type=creature" onclick="toggle_filter(this.value)">Creature</button>
            <button name="filter" value="type=instant" onclick="toggle_filter(this.value)">Instant</button>
            <button name="filter" value="type=artifact" onclick="toggle_filter(this.value)">Artifact</button>
            <button name="filter" value="type=enchantment" onclick="toggle_filter(this.value)">Enchantment</button>
            <button name="filter" value="type=sorcery" onclick="toggle_filter(this.value)">Sorcery</button>
            <button name="filter" value="type=planeswalker" onclick="toggle_filter(this.value)">Planeswalker</button>
            <button name="filter" value="type=land" onclick="toggle_filter(this.value)">Land</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Rarity</button>
        <div class="dropdown-content">
            <button name="filter" value="rarity=common" onclick="toggle_filter(this.value)">Common</button>
            <button name="filter" value="rarity=uncommon" onclick="toggle_filter(this.value)">Uncommon</button>
            <button name="filter" value="rarity=rare" onclick="toggle_filter(this.value)">Rare</button>
            <button name="filter" value="rarity=mythic" onclick="toggle_filter(this.value)">Mythic</button>
        </div>
    </div>

    <!-- <div class="dropdown">
        <button class="dropbtn"
            onclick="window.location.assign('http://localhost/PokemonCompendium/gallery.php');">Reset</button>
    </div> -->
</div>


<section id="card_container"></section>


<section id="pagination_bar">
    <button id="previous_button">Previous Page</button>
    <button id="current_page_display">Page 1</button>
    <button id="next_button">Next Page</button>
</section>


<input id="current_page_counter" type="hidden" value="1">
<input id="number_of_pages_counter" type="hidden" value="1">


<script>
function add_to_deck(id) {
    $.ajax({
        type: "POST",
        url: "handle_session.php",
        data: {
            card_id: id
        },
        success: function(response) {
            //console.log(response);
            alert("Card successfully added!");
        }
    });
}

// apply all active filter buttons (i.e. filters applied in URL)
let string_url = window.location.href;
for (let i = 0; i < document.getElementsByName('filter').length; i++) {
    if (string_url.indexOf(document.getElementsByName('filter')[i].value) > -1) {
        document.getElementsByName('filter')[i].setAttribute("class", "active-button");
    }
}
</script>

<?php require_once('templates/footer.php'); ?>