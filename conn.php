<?php
$db_name="registration";
$username="root";
$password="";
$server_name="localhost";
$conn=mysqli_connect($server_name,$username,$password,$db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
