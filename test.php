<?php

// Will put this on a separate configuration file but for now and testing purposes it will be here.
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "theNilePassword";
$dbname = "TheNile";

$name = addslashes($_POST["name"]);
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$income = $_POST["income"];


// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO User (name, email, username,password,income)
VALUES ('".$name."','".$email."','".$username."','".$password."','".$income."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);




 ?>
