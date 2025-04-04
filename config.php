<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "user_verification";


$conn = new mysqli($host, $user, $password, $database);

if ($conn -> connect_error){
die("CONNECTION FAILED!". $conn -> connect_error);
    
}

date_default_timezone_set("Asia/Manila");
?>