<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch club list from the database
$clubListQuery = "SELECT id, name FROM club_list WHERE status = 1";
$clubListResult = $conn->query($clubListQuery);

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $attendees = $_POST["attendees"];
    $eventDate = $_POST["event_date"];
    $clubId = $_POST["club"];

    // Handle image upload
    $imagePath = null;
    if ($_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        $imagePath = $targetFile;
    }

    // SQL query to insert data into registrations table
    $sql = "INSERT INTO registrations (name, email, phone, attendees, event_date, club_id, image) 
            VALUES ('$name', '$email', '$phone', $attendees, '$eventDate', $clubId, '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



$conn->close();
?>
