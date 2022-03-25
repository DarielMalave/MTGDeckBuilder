<?php
include ("setup_db.php");

$mysqli = db_iconnect("mtg");
$all_cards = array();
// accept $_SESSION deck string and split it into array
$deck = $_POST['deck'];
$deck_array = explode(",", $deck);

// iterate through every id and search database, adding card info to all_cards
$i = 0;
foreach ($deck_array as $id) {
    if (empty($id)) continue;

    $query = "SELECT * FROM cards WHERE auto_id=" . strval($id);
    $result = $mysqli->query($query) or die($mysqli->error);
    $all_cards[$i] = $result->fetch_assoc();
    $i++;
}

// return deck data as JSON
$updated_all_cards = rawurlencode(json_encode($all_cards));
echo $updated_all_cards;