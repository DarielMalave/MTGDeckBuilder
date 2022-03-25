<?php

//session_start();

$card_id = $_POST['card_id'];
$card_id = "," . strval($card_id);
$new_deck = $_COOKIE['deck'];
$new_deck .= $card_id;

setcookie("deck", $new_deck, time() + 3600, '/');
//echo $previous_deck;

// $placeholder = $_SESSION['deck'];
// $placeholder .= $card_id;
// $_SESSION['deck'] = $placeholder;

// if (isset($_SESSION['deck'])) {
//     $_SESSION['deck'] += "," + $card_id;
// }
// else {
//     $_SESSION['deck'] = $card_id;
// }