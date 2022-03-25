<?php

session_start();

$card_id = $_POST['card_id'];
$card_id = "," . strval($card_id);

$placeholder = $_SESSION['deck'];
$placeholder .= $card_id;
$_SESSION['deck'] = $placeholder;

// if (isset($_SESSION['deck'])) {
//     $_SESSION['deck'] += "," + $card_id;
// }
// else {
//     $_SESSION['deck'] = $card_id;
// }