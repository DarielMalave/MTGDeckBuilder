<?php require_once('templates/header.php'); ?>

<!-- creature, instant, artifact, enchantment, sorcery, planeswalker, land -->
<h1>Standard Deck</h1>

<h2>Creature</h2>
<section id="card_container" class="creature"></section>

<h2>Instant</h2>
<section id="card_container" class="instant"></section>

<h2>Artifact</h2>
<section id="card_container" class="artifact"></section>

<h2>Enchantment</h2>
<section id="card_container" class="enchantment"></section>

<h2>Sorcery</h2>
<section id="card_container" class="sorcery"></section>

<h2>Planeswalker</h2>
<section id="card_container" class="planeswalker"></section>

<h2>Land</h2>
<section id="card_container" class="land"></section>

<script>
let data_source;
let card_types = ["Creature", "Instant", "Artifact", "Enchantment", "Sorcery", "Planeswalker", "Land"];
let creature_cards = [];
let instant_cards = [];
let artifact_cards = [];
let enchantment_cards = [];
let sorcery_cards = [];
let planeswalker_cards = [];
let land_cards = [];

$.ajax({
    type: "POST",
    url: "process.php",
    data: {
        cardCountUpdated: 0,
        rowsPerPage: 10,
        string_url: "http://localhost/PokemonCompendium/gallery.php"
    },
    success: function(response) {
        data_source = JSON.parse(decodeURIComponent(response));
        displayList(data_source, document.getElementsByClassName("creature")[0], 10);
        displayList(data_source, document.getElementsByClassName("instant")[0], 10);
        format_deck(data_source);
    }
});

// let text = "Hello world, welcome to the universe.";
// let result = text.includes("world");

function format_deck(data_source) {
    for (let i = 0; i < data_source.length; i++) {
        // clean card type name function here to take care of 
        // "artifact creature" and "enchantment creature"
        // it works by taking the last card type
        if (data_source[i].type.includes("Creature")) {
            creature_cards.push(data_source[i]);
        }
    }
}

function displayList(data_source, wrapper, rows_per_page) {
    wrapper.innerHTML = "";

    if (data_source.length === 0) {
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

</script>

<?php require_once('templates/footer.php'); ?>