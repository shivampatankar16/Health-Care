<?php
/* Database Configuration */
$host = "localhost";
$user = "root";
$pass = "";
$db   = "hospital_db";

/* Create Connection */
$conn = mysqli_connect($host, $user, $pass, $db);

/* Check Connection */
if(!$conn){
    die("Database Connection Failed : " . mysqli_connect_error());
}
?>