<?php

// Will put this on a separate configuration file but for now and testing purposes it will be here.

/**
 * include("Header.php");
 * $arr = array("name"=>$_POST['name'], ...);
 * $u = new User($arr);
 * 
 */

$name = addslashes($_POST["name"]);
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$income = $_POST["income"];


// Create connection
$conn = new database();
$conn->open()

$sql = "INSERT INTO User (name, email, username,password,income)
VALUES ('".$name."','".$email."','".$username."','".$password."','".$income."')";

if ($conn->query($sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->getError();
}
$conn->close()

 ?>
