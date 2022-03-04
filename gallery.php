<?php require_once('templates/header.php'); ?>

<div id="card_modal" class="modal">
    <div class="modal-content">

        <div id="modal_title">
            <p id="modal_text"></p>
            <span id="close">&times;</span>
        </div>

        <div id="modal_body">
            <!-- <img id="modal_image">
            <p id="modal_flavor"></p> -->
        </div>

    </div>
</div>

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
            <button id="set_filter" value="card_set=vow" onclick="toggle_filter(this.value)">Crimson Vow</button>
            <button id="set_filter" value="card_set=mid" onclick="toggle_filter(this.value)">Midnight Hunt</button>
            <button id="set_filter" value="card_set=afr" onclick="toggle_filter(this.value)">Adventures in the Forgotten
                Realms</button>
            <button id="set_filter" value="card_set=stx" onclick="toggle_filter(this.value)">Strixhaven: School of
                Mages</button>
            <button id="set_filter" value="card_set=khm" onclick="toggle_filter(this.value)">Kaldheim</button>
            <button id="set_filter" value="card_set=znr" onclick="toggle_filter(this.value)">Zendikar Rising</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">CMC</button>
        <div class="dropdown-content">
            <button id="set_filter" value="cmc=1" onclick="toggle_filter(this.value)">1</button>
            <button id="set_filter" value="cmc=2" onclick="toggle_filter(this.value)">2</button>
            <button id="set_filter" value="cmc=3" onclick="toggle_filter(this.value)">3</button>
            <button id="set_filter" value="cmc=4" onclick="toggle_filter(this.value)">4</button>
            <button id="set_filter" value="cmc=5" onclick="toggle_filter(this.value)">5</button>
            <button id="set_filter" value="cmc=6" onclick="toggle_filter(this.value)">6</button>
            <button id="set_filter" value="cmc=7" onclick="toggle_filter(this.value)">7</button>
            <button id="set_filter" value="cmc=8" onclick="toggle_filter(this.value)">8</button>
            <button id="set_filter" value="cmc=9" onclick="toggle_filter(this.value)">9</button>
            <!-- add 12 CMC filter? -->
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Color Identity</button>
        <div class="dropdown-content">
            <button id="set_filter" value="manaCost={R}" onclick="toggle_filter(this.value)">Red</button>
            <button id="set_filter" value="manaCost={U}" onclick="toggle_filter(this.value)">Blue</button>
            <button id="set_filter" value="manaCost={G}" onclick="toggle_filter(this.value)">Green</button>
            <button id="set_filter" value="manaCost={W}" onclick="toggle_filter(this.value)">White</button>
            <button id="set_filter" value="manaCost={B}" onclick="toggle_filter(this.value)">Black</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Type</button>
        <div class="dropdown-content">
            <button id="set_filter" value="type=creature" onclick="toggle_filter(this.value)">Creature</button>
            <button id="set_filter" value="type=instant" onclick="toggle_filter(this.value)">Instant</button>
            <button id="set_filter" value="type=artifact" onclick="toggle_filter(this.value)">Artifact</button>
            <button id="set_filter" value="type=enchantment" onclick="toggle_filter(this.value)">Enchantment</button>
            <button id="set_filter" value="type=sorcery" onclick="toggle_filter(this.value)">Sorcery</button>
            <button id="set_filter" value="type=planeswalker" onclick="toggle_filter(this.value)">Planeswalker</button>
            <button id="set_filter" value="type=land" onclick="toggle_filter(this.value)">Land</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Rarity</button>
        <div class="dropdown-content">
            <button id="set_filter" value="rarity=common" onclick="toggle_filter(this.value)">Common</button>
            <button id="set_filter" value="rarity=uncommon" onclick="toggle_filter(this.value)">Uncommon</button>
            <button id="set_filter" value="rarity=rare" onclick="toggle_filter(this.value)">Rare</button>
            <button id="set_filter" value="rarity=mythic" onclick="toggle_filter(this.value)">Mythic</button>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn"
            onclick="window.location.assign('http://localhost/PokemonCompendium/gallery.php');">Reset</button>
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


<script>
let modal = document.getElementById("card_modal");
let btn = document.getElementById("myBtn");
let span = document.getElementById("close");

function modal_config(index) {
    console.log(index);
    console.log(data_source[index]);

    let modal_text = document.getElementById("modal_text");
    let modal_body = document.getElementById("modal_body");
    modal_body.innerHTML = "";

    let modal_image = document.createElement("img");
    let modal_text_body = document.createElement("ul");
    let modal_description = document.createElement("li");
    let modal_cmc = document.createElement("li");
    let modal_rarity = document.createElement("li");
    let modal_flavor = document.createElement("li");
    let modal_button = document.createElement("button");

    modal_text.innerText = data_source[index]['name'] + " (" + data_source[index]['card_set'] + ")";

    modal_image.src = data_source[index]['imageUrl'];

    modal_cmc.innerHTML = "<span>Converted Mana Cost:</span> " + data_source[index]['cmc'];
    modal_rarity.innerHTML = "<span>Card Rarity:</span> " + data_source[index]['rarity'];
    modal_description.innerText = data_source[index]['text'];
    modal_flavor.innerHTML = (data_source[index]['flavor']) ? "<span>Card Flavor Text:</span><i> " + data_source[index]['flavor'] + "</i>" : "<span>No Flavor Text</span>";
    modal_button.innerText = "Add to Deck";
    modal_button.classList.add("dropbtn");

    modal_text_body.appendChild(modal_cmc);
    modal_text_body.appendChild(modal_rarity);
    modal_text_body.appendChild(modal_description);
    modal_text_body.appendChild(modal_flavor);
    modal_text_body.appendChild(modal_button);
    modal_body.appendChild(modal_image);
    modal_body.appendChild(modal_text_body);
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php require_once('templates/footer.php'); ?>