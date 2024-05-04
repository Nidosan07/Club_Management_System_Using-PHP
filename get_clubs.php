<?php
// get_clubs.php

// Connection to the database (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the registration_id from the AJAX request
$registrationId = $_POST['registration_id'];

// Fetch clubs based on the selected event name
$club_query = "SELECT id, name FROM clubs WHERE registration_id = ?";
$stmt = $conn->prepare($club_query);
$stmt->bind_param("i", $registrationId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<option value="">Select Club</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
} else {
    echo '<option value="">No clubs found for this event</option>';
}

$stmt->close();
$conn->close();
?>
