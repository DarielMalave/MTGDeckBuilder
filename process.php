<?php
include ("setup_db.php");
include ("process/structure_query.php");

// search cards based on:
// manaCost, cmc, type, rarity, card_set

$mysqli = db_iconnect("mtg");
$all_cards = array();
$string_url = $_POST['string_url'];
$cardUpdatedCount = $_POST['cardCountUpdated'];
$rowsPerPage = $_POST['rowsPerPage'];

$query = structure_query($string_url);

// perform separate query to get total number of cards in a search
// query before adding pagination limits
//$result_num_rows = $mysqli->query($query) or die($mysqli->error);
//$total_num_cards = mysqli_num_rows($result_num_rows);

// add in pagination parameters at the end
$query .= " LIMIT $cardUpdatedCount, $rowsPerPage;";

$result = $mysqli->query($query) or die($mysqli->error);

$i = 0;
while($row = $result->fetch_assoc()) {
    $all_cards[$i] = $row;
    $i ++;
}
//$all_cards[$i] = $total_num_cards;

$updated_all_cards = rawurlencode(json_encode($all_cards));
echo $updated_all_cards;

//$updated_all_cards = rawurlencode(json_encode($all_cards));
//echo $updated_all_cards;
//mysqli_close($mysqli);