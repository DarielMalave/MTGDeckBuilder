<?php
include ("setup_db.php");

$mysqli = db_iconnect("mtg");

// name, mana cost, cmc, imageUrl, type, types, rarity, set, text, flavor, artist, multiverseid, id

//$query = $mysqli->query("INSERT types FROM cards order by CID desc limit 1") or die($mysqli->error);
//$rowForCID = $fetchCID->fetch_assoc();
//$lastCID = $rowForCID['CID'];

$all_cards = json_decode(file_get_contents("card_information/crimson_vow.json"), true);
// echo "<pre>";
// print_r($all_cards['cards']);
// echo "</pre>";

// foreach ($all_cards['cards'] as $card) {
//     $card_type = $card['types'];
//     echo gettype($card_type);
//     print_r($card_type);
//     echo "<br>";

//     $new_card_type = serialize($card['types']);
//     echo gettype($new_card_type);
//     echo $new_card_type;
//     echo "<br>";

//     $new_new_card_type = unserialize($new_card_type);
//     echo gettype($new_new_card_type);
//     print_r($new_new_card_type);
//     echo "<br>";
//     echo "<br>";
//     echo "<br>";
// }

// name, mana cost, cmc, imageUrl, type, rarity, set, text, flavor, artist, multiverseid, id
foreach ($all_cards['cards'] as $card) {
    $insert_name = $mysqli->real_escape_string($card['name']);
    $insert_mana_cost = $mysqli->real_escape_string($card['manaCost']);
    $insert_cmc = $mysqli->real_escape_string($card['cmc']);
    $insert_image_url = $mysqli->real_escape_string($card['imageUrl']);
    $insert_type = $mysqli->real_escape_string($card['type']);
    $insert_rarity = $mysqli->real_escape_string($card['rarity']);
    $insert_card_set = $mysqli->real_escape_string($card['set']);
    $insert_text = $mysqli->real_escape_string($card['text']);
    $insert_flavor = $mysqli->real_escape_string($card['flavor']);
    $insert_artist = $mysqli->real_escape_string($card['artist']);
    $insert_multiverseid = $mysqli->real_escape_string($card['multiverseid']);
    $insert_id = $mysqli->real_escape_string($card['id']);
    $query = "INSERT INTO cards (name, manaCost, cmc, imageUrl, type, rarity, card_set, text, flavor, artist, multiverseid, id) VALUES('$insert_name', '$insert_mana_cost', '$insert_cmc', '$insert_image_url', '$insert_type', '$insert_rarity', '$insert_card_set', '$insert_text', '$insert_flavor', '$insert_artist', '$insert_multiverseid', '$insert_id');";
    $mysqli->query($query) or die($mysqli->error);
}


// $query_test = "SELECT types FROM cards;";
// $result = $mysqli->query($query_test) or die($mysqli->error);
// while($row = $result->fetch_assoc()) {
//     $get_card_types = unserialize($row['types']);
//     echo '<pre>';
//     print_r($get_card_types);
//     echo '</pre>';
//     echo $get_card_types['0'];
// }