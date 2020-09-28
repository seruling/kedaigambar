<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
error_reporting(E_ALL);
define("SECURE", TRUE); 
$host = "localhost";
$db_username = "kedaigambar";
$db_password = "MySQL@332";
$database = "kedaigambar";
$conn = mysqli_connect($host,$db_username,$db_password,$database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

