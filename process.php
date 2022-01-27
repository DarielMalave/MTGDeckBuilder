<?php
include ("setup_db.php");

$mysqli = db_iconnect("mtg");
$all_cards = array();
$string_url = $_POST['string_url'];
$cardUpdatedCount = $_POST['cardCountUpdated'];
$rowsPerPage = $_POST['rowsPerPage'];

$query = structure_query($string_url);
//WHERE card_set = '$cardSet' LIMIT $cardUpdatedCount, $rowsPerPage;

$query .= " LIMIT $cardUpdatedCount, $rowsPerPage;";

// get length
$result = $mysqli->query($query) or die($mysqli->error);
$i = 0;
while($row = $result->fetch_assoc()) {
    $all_cards[$i] = $row;
    $i ++;
}

$updated_all_cards = rawurlencode(json_encode($all_cards));
echo $updated_all_cards;

function structure_query($url) {
    // Instead of using $_GET variables, grabbing and parsing the URL
    // will be used in order to get filters of the same type
    // For example: if a user wants to search for cards from VOW and MID,
    // it's easier to use/parse the URL instead of grabbing values
    // from $_GET
    $string_url = $url;

    // All filters from the URL will be stored in this array and then
    // added to the query string at the end
    $all_filters = array();

    // Get URL string after the question mark
    $filter_params = substr($string_url, strpos($string_url, "?") + 1);    

    // Get individual filters from splitting the array based on &
    $pair_of_filters = explode("&", $filter_params);
    if (empty($filter_params) || empty(strpos($string_url, "?"))) {
	    return "SELECT * FROM cards";
    }

    // Base query string used to fetch cards from database
    $query = "SELECT * FROM cards WHERE ";

    // order filters by alphabetical order
    // for example, if URL looks like ?card_set=vow&type=instant&card_set=mid,
    // that would mess up the algorithm coming after this. Also it's
    // easier to read and parse filters when values of the same
    // type are together
    sort($pair_of_filters);

    // Iterate through each individual filter and add them to $all_filters 
    // as SQL clauses
    foreach ($pair_of_filters as $index => $filter) {
	    $create_filter = explode("=", $filter);
        if ($index == 0) {
    	    $all_filters[] = "$create_filter[0] = '$create_filter[1]'";
            continue;
        }
    
        $previous_filter_type = $all_filters[$index - 1];
        $previous_filter_type = trim($previous_filter_type, "AND ");
        $previous_filter_type = trim($previous_filter_type, "OR ");
        $previous_filter_type = substr($previous_filter_type, 0, strlen($create_filter[0]));
    
        // if not first element and this filter has same type as previous filter
        if (strcmp($create_filter[0], $previous_filter_type) == 0) {
    	    $all_filters[] = "OR $create_filter[0] = '$create_filter[1]'";
        }
        else {
		    $all_filters[] = "AND $create_filter[0] = '$create_filter[1]'";
        }
    }

    foreach ($all_filters as $index => $filter) {
	    $query .= $filter . " ";
    }

    return $query;
}