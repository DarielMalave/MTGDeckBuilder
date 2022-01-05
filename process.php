<?php

//$json = '{"1":"a","2":"b","3":"c","4":"d","5":"e"}';
// retrieves text from .json file as a string
$json = file_get_contents('crimson_vow.json');
// decodes the .json text as an array
$obj = json_decode($json, TRUE);
//print_r($obj['cards']);

foreach($obj['cards'] as $key => $value) {
    echo 'Card number: ' . $key . ' and contents of the card are:';

    echo '<pre>';
    print_r($value['name']);
    echo '</pre>';

    echo "<img src=" . $value['imageUrl'] . " alt='About picture here.'>";
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
}