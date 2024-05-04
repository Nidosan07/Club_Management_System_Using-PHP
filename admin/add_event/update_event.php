<?php
// Your database connection code here
$conn = new mysqli("localhost", "root", "", "ncas_db");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    // Add other form fields as needed

    // Update the event details in the database
    $update_query = "UPDATE registrations SET name = '$name' WHERE id = $event_id";
    // Add other fields to update as needed

    $result = $conn->query($update_query);

    if ($result) {
        // Redirect back to the main page after updating
        header("Location: index.php"); // Replace 'index.php' with the actual filename of your main page
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
