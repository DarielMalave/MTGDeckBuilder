<?php
include ("setup_db.php");

$mysqli = db_iconnect("mtg");
$all_cards = array();
$cardUpdatedCount = $_POST['cardCountUpdated'];
$rowsPerPage = $_POST['rowsPerPage'];
$query = "SELECT * FROM cards LIMIT $cardUpdatedCount, $rowsPerPage;";
$result = $mysqli->query($query) or die($mysqli->error);
$i = 0;
while($row = $result->fetch_assoc()) {
    $all_cards[$i] = $row;
    $i ++;
}

$updated_all_cards = rawurlencode(json_encode($all_cards));
echo ($updated_all_cards);
