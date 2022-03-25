let data_source;
let creature_cards = [];
let instant_cards = [];
let artifact_cards = [];
let enchantment_cards = [];
let sorcery_cards = [];
let planeswalker_cards = [];
let land_cards = [];

$.ajax({
    type: "POST",
    url: "format_deck_source.php",
    data: {
        deck: deck_string
    },
    success: function(response) {
        data_source = JSON.parse(decodeURIComponent(response));
        format_deck(data_source);
    }
});