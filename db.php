<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "shopnest";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Session start for login management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>