<?php
include ("setup_db.php");
include ("process/structure_query.php");

$mysqli = db_iconnect("mtg");
$all_cards = array();
$string_url = $_POST['string_url'];
$cardUpdatedCount = $_POST['cardCountUpdated'];
$rowsPerPage = $_POST['rowsPerPage'];

$query = structure_query($string_url);

$result_num_rows = $mysqli->query($query) or die($mysqli->error);
$total_num_cards = mysqli_num_rows($result_num_rows);

echo ceil($total_num_cards / $rowsPerPage);