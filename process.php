<?php
include ("setup_db.php");

$mysqli = db_iconnect("mtg");
$all_cards = array();
$cardUpdatedCount = $_POST['cardCountUpdated'];
$rowsPerPage = $_POST['rowsPerPage'];
$cardSet = $_POST['cardSet'];
$all_filters = array();
// start with basic select query and then add to query string with appropriate
// filters set by user
$query = "SELECT * FROM cards";
//WHERE card_set = '$cardSet' LIMIT $cardUpdatedCount, $rowsPerPage;
if ($cardSet) {
    $query .= " WHERE ";
    $query .= " card_set = '$cardSet' ";
}

$query .= " LIMIT $cardUpdatedCount, $rowsPerPage;";

$result = $mysqli->query($query) or die($mysqli->error);
$i = 0;
while($row = $result->fetch_assoc()) {
    $all_cards[$i] = $row;
    $i ++;
}

$updated_all_cards = rawurlencode(json_encode($all_cards));
echo ($updated_all_cards);
