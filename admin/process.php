<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "scas_db";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $attendees = $_POST["attendees"];
    $eventDate = $_POST["eventDate"];

    // Prepare and execute SQL query
    $sql = "INSERT INTO registrations (name, email, phone, attendees, event_date) VALUES ('$name', '$email', '$phone', $attendees, '$eventDate')";
    if ($conn->query($sql) === TRUE) {
        echo_flashdata('success',"User has been added successfully.");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
