<?php

$card_id = $_POST['card_id'];
$card_id = "," . strval($card_id);
$new_deck = $_COOKIE['deck'];
$new_deck = str_replace($card_id, "", $new_deck);

setcookie("deck", $new_deck, time() + 3600, '/');