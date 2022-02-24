<?php

//set_time_limit(0);
//ini_set('memory_limit', '-1');

// borrowed this context array from StackOverflow due to SSL problems
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

//$response = file_get_contents("https://ec2-3-19-123-182.us-east-2.compute.amazonaws.com/equipment.txt", false, stream_context_create($arrContextOptions));
//$response_array = explode(PHP_EOL, $response);
//echo $response;
// echo "<pre>";
// print_r($response_array);
// echo "</pre>";

$mysqli = db_iconnect('devices');
$statement = mysqli_stmt_init($mysqli);
if (!$statement) {
    exit("<p>Failed to initialize statement</p>");
}

$query = "INSERT INTO equipment (device_type, manufacturer, serial_number) VALUES (?, ?, ?);";
if (!mysqli_stmt_prepare($statement, $query)) {
    exit("<p>Failed to prepare statement.</p>");
}

$handle = fopen("equipment.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        mysqli_stmt_bind_param($statement, "sss", $device_type, $manufacturer, $serial_number);
        $record_split = explode(",", $line);

        $device_type = $record_split[0];
        $manufacturer = $record_split[1];
        $serial_number = $record_split[2];

        if (mysqli_stmt_execute($statement)) {
            //echo "record successfully inserted";
        }
        else {
            echo "<p>Record failed to insert.</p>";
        }
    }

    fclose($handle);
} else {
    echo "Failed to open file.";
} 

// foreach ($response_array as $record) {
//     mysqli_stmt_bind_param($statement, "sss", $device_type, $manufacturer, $serial_number);

//     $record_split = explode(",", $record);

//     $device_type = $record_split[0];
//     $manufacturer = $record_split[1];
//     $serial_number = $record_split[2];

//     if (mysqli_stmt_execute($statement)) {
//         //echo "record successfully inserted";
//     }
//     else {
//         echo "<p>Record failed to insert.</p>";
//     }
// }

echo "Data transfer completed! *dab*";
echo "yyeeeeeaaaaahhhhh baby that' what I've been looking for";


function db_iconnect($db) {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$mysqli = new mysqli($hostname,$username,$password,$db);
	if (mysqli_connect_error()) {
		die("Unable to connect to $db: " . mysqli_connect_error());
	}
	return $mysqli;
}