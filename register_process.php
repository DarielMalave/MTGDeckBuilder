<?php
include ("setup_db.php");
$mysqli = db_iconnect("mtg");

$username = $_POST['username'];
$password = $_POST['password'];
$reenter = $_POST['reenter'];

// check for duplicate user

$statement = mysqli_stmt_init($mysqli);
if (!$statement) {
    exit("<p>Failed to initialize statement</p>");
}

$query = "INSERT INTO users (username, password) VALUES (?, ?);";
if (!mysqli_stmt_prepare($statement, $query)) {
    exit("<p>Failed to prepare statement.</p>");
}

mysqli_stmt_bind_param($statement, "ss", $username, $password);

if (!mysqli_stmt_execute($statement)) {
    echo "<p>Record failed to insert.</p>";
}

header("location: login.php?register=true");