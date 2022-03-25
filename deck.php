<?php 
    require_once('templates/deck_header.php');
    require_once('templates/modal_template.php');
?>

<?php
    if (!isset($_COOKIE['deck'])) {
        setcookie("deck", ",13,54,11,23,90,21,155,192,500,789", time() + 3600, '/');
        header("location: deck.php");
    }
?>

<div class="title_con">
    <h1>Standard Deck</h1>
</div>

<div class="title_con">
    <h2>Standard Rules</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                <ul>
                    <li>Your deck must be at least 60 cards.</li>
                    <br>
                    <li>Up to fifteen cards may be included in your sideboard, if you use one.</li>
                    <br>
                    <li>Include no more than four copies of any individual card in your main deck and sideboard combined
                        (except basic lands).</li>
                    <br>
                    <li>There's no maximum deck size, as long as you can shuffle your deck in your hands unassisted.
                    </li>
                </ul>
                <br>
                <a href="https://magic.wizards.com/en/formats/standard"
                    target="_blank">https://magic.wizards.com/en/formats/standard</a>
            </div>
        </div>
    </div>
</div>

<!-- <div class="title_con">
    <h2>Number of Cards</h2>
</div>

<div class="title_con">
    <h2>Average CMC</h2>
</div> -->

<div class="title_con">
    <h2>Creature</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                In Magic: The Gathering, creature is a permanent card type.
                <br>
                <br>
                Flavorwise, creatures represent Warriors, Minions, Beasts,
                and Monsters that serve the player, usually by fighting on their behalf.
                Because almost all creatures can attack each turn to reduce an opponent's
                life or block the opponent's attackers, creature cards are fundamental
                to most deck strategies.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Creature" target="_blank">https://mtg.fandom.com/wiki/Creature</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="creature"></section>

<div class="title_con">
    <h2>Instant</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                Instants, like sorceries, represent one-shot or short-term magical spells.
                They are never put onto the battlefield; instead, they take effect when their
                mana cost is paid and the spell resolves, and then are immediately put into
                the player's graveyard.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Instant" target="_blank">https://mtg.fandom.com/wiki/Instant</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="instant"></section>

<div class="title_con">
    <h2>Artifact</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                Artifacts are permanents that represent magical items,
                animated constructs, pieces of equipment, or other objects
                and devices. Artifact, the card type, is broader than the normal
                definition. Natural items can be a Magic “artifact”.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Artifact" target="_blank">https://mtg.fandom.com/wiki/Artifact</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="artifact"></section>

<div class="title_con">
    <h2>Enchantment</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                Enchantments represent persistent magical effects,
                usually remaining in play indefinitely.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Enchantment"
                    target="_blank">https://mtg.fandom.com/wiki/Enchantment</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="enchantment"></section>

<div class="title_con">
    <h2>Sorcery</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                Sorceries, like instants, represent one-shot or short-term magical spells.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Sorcery" target="_blank">https://mtg.fandom.com/wiki/Sorcery</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="sorcery"></section>

<div class="title_con">
    <h2>Planeswalker</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                In the storyline of Magic: The Gathering,
                planeswalkers are among the most powerful beings in the multiverse.
                Within the game, they represent the thematic identities of the players.
                Planeswalker is also a card type within the game.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Planeswalker"
                    target="_blank">https://mtg.fandom.com/wiki/Planeswalker</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="planeswalker"></section>

<div class="title_con">
    <h2>Land</h2>
    <div class="dropdown">
        <img src="images/circle-question-solid.svg" class="icon">
        <div class="dropdown-content">
            <div class="info_text">
                Lands represent locations under the player's control,
                most of which have mana abilities. Because mana is needed to use
                almost any card or ability, most decks need a high number of mana-producing
                lands (typically between 33-50% of the total deck) in order to function effectively.
                The most commonly printed Magic cards are the five basic lands, one for each color,
                each of which intrinsically produce one mana of a specific color.
                <br>
                <br>
                <a href="https://mtg.fandom.com/wiki/Land" target="_blank">https://mtg.fandom.com/wiki/Land</a>
            </div>
        </div>
    </div>
</div>
<section id="card_container" class="land"></section>

<script>
<?php
    echo "let deck_string = '" . $_COOKIE['deck'] . "';";
?>

function remove_from_deck(id) {
    $.ajax({
        type: "POST",
        url: "handle_delete.php",
        data: {
            card_id: id
        },
        success: function(response) {
            //console.log(response);
            alert("Card successfully removed!");
            window.location.assign('http://localhost/PokemonCompendium/deck.php');
        }
    });
}

function displayList(data_source, wrapper, rows_per_page) {
    wrapper.innerHTML = "";

    if (data_source.length === 0) {
        return;
    }

    for (let i = 0; i < rows_per_page; i++) {
        let card_element = document.createElement('div');
        let card_image = document.createElement('img');

        card_image.src = data_source[i]['imageUrl'];
        card_image.classList.add('lazy_load');
        card_image.setAttribute("index", i);
        card_image.setAttribute("onclick", "modal_config(" + i + ")");
        card_image.setAttribute("onload", "lazy_loading(this)");

        card_element.appendChild(card_image);
        wrapper.appendChild(card_element);
    }
}
</script>

<?php require_once('templates/footer.php'); ?>