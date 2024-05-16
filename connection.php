<?php

$hostname = "localhost";
$db_username = "root";
$db_password = "1234";
$database = "admin_db";

$conn = new mysqli($hostname, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>