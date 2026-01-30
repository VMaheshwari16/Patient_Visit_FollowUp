<?php
$host = "localhost";
$user = "root";
$pass = "GVK#smum4";
$db   = "healthcare_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
