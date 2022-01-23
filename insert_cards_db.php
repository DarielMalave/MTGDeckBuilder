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

// foreach ($all_cards['cards'] as $card) {
//     $insert_card_type = serialize($card['types']);
//     $query = "INSERT INTO cards (types) VALUES('$insert_card_type');";
//     $mysqli->query($query) or die($mysqli->error);
// }


// $query_test = "SELECT types FROM cards;";
// $result = $mysqli->query($query_test) or die($mysqli->error);
// while($row = $result->fetch_assoc()) {
//     // echo '<pre>';
//     // print_r($row);
//     // echo '</pre>';

//     $get_card_types = unserialize($row['types']);
//     echo '<pre>';
//     print_r($get_card_types);
//     echo '</pre>';
//     echo $get_card_types['0'];
// }