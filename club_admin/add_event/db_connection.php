<?php
// db_connection.php

$servername = "localhost";
$username = "";
$password = "root";
$dbname = "scas_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
