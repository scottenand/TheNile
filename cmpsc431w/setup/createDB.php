<?php

$keys = array(1 => "username", 2 => "password", 3 => "databaseIP", 4 => "databaseName");
$args = array();

foreach($argv as $i => $v) {
	if($i != 0) {
		$args[$keys[$i]] = $v;
	}
}
if(!isset($args["databaseName"]))
	$args["databaseName"] = "431w";

if(count($args) != 4)
	die("This script is meant to be called via the command line.\nUSE: setup.php <MySQL username> <MySQL password> [<databaseIP = localhost> [<databaseName = 431w>]]");

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE " . $args["databaseName"];
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->close();

?>