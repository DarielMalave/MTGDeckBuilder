<?php require_once('templates/deck_header.php'); ?>

<!-- creature, instant, artifact, enchantment, sorcery, planeswalker, land -->
<div class="title_con">
    <h1>Standard Deck</h1>
</div>

<div class="title_con">
    <h2>Creature<i class="fas-solid fa-circle-question"></i></h2>
</div>
<section id="card_container" class="creature"></section>

<div class="title_con">
    <h2>Instant</h2>
</div>
<section id="card_container" class="instant"></section>

<div class="title_con">
    <h2>Artifact</h2>
</div>
<section id="card_container" class="artifact"></section>

<div class="title_con">
    <h2>Enchantment</h2>
</div>
<section id="card_container" class="enchantment"></section>

<div class="title_con">
    <h2>Sorcery</h2>
</div>
<section id="card_container" class="sorcery"></section>

<div class="title_con">
    <h2>Planeswalker</h2>
</div>
<section id="card_container" class="planeswalker"></section>

<div class="title_con">
    <h2>Land</h2>
</div>
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
        //displayList(data_source, document.getElementsByClassName("creature")[0], 10);
        //displayList(data_source, document.getElementsByClassName("instant")[0], 10);
        format_deck(data_source);
    }
});

// let text = "Hello world, welcome to the universe.";
// let result = text.includes("world");

// also have function to sort cards by alphabetical order in each category
// account for double-sided cards too
function format_deck(data_source) {
    for (let i = 0; i < data_source.length; i++) {
        // clean card type name function here to take care of 
        // "artifact creature" and "enchantment creature"
        // it works by taking the last card type
        if (data_source[i].type.includes("Creature")) {
            creature_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Instant")) {
            instant_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Artifact")) {
            artifact_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Enchantment")) {
            enchantment_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Sorcery")) {
            sorcery_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Planeswalker")) {
            planeswalker_cards.push(data_source[i]);
        }
        else if (data_source[i].type.includes("Land")) {
            land_cards.push(data_source[i]);
        }
    }

    displayList(creature_cards, document.getElementsByClassName("creature")[0], creature_cards.length);
    displayList(instant_cards, document.getElementsByClassName("instant")[0], instant_cards.length);
    displayList(artifact_cards, document.getElementsByClassName("artifact")[0], artifact_cards.length);
    displayList(enchantment_cards, document.getElementsByClassName("enchantment")[0], enchantment_cards.length);
    displayList(sorcery_cards, document.getElementsByClassName("sorcery")[0], sorcery_cards.length);
    displayList(planeswalker_cards, document.getElementsByClassName("planeswalker")[0], planeswalker_cards.length);
    displayList(land_cards, document.getElementsByClassName("land")[0], land_cards.length);
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