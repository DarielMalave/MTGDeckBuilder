<?php
include ("setup_db.php");
$mysqli = db_iconnect("mtg");

$username = $_POST['username'];
$password = $_POST['password'];

$statement = mysqli_stmt_init($mysqli);
if (!$statement) {
    exit("<p>Failed to initialize statement</p>");
}

$query = "SELECT * FROM users WHERE username= ? AND password= ?";
if (!mysqli_stmt_prepare($statement, $query)) {
    exit("<p>Failed to prepare statement.</p>");
}

mysqli_stmt_bind_param($statement, "ss", $username, $password);

if (!mysqli_stmt_execute($statement)) {
    echo "<p>Record failed to insert.</p>";
}

$result = $statement->get_result();
$row = $result->fetch_assoc();

echo "<pre>";
print_r($row);
echo "</pre>";



//$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
//$result = $mysqli->query($query) or die("Something went wrong with: $sql<br>".$mysqli->error());

// if ($result->num_rows == 1) {
//     while($row = $result->fetch_assoc()) {
//         session_start();
//         $_SESSION['loginName'] = $username;
//         $_SESSION['id'] = $row['id'];
//         header("location: protoMain.php");
//         exit();
//     }
// } 
// else {
//     header("location: login.php?status=incorrect");
// }