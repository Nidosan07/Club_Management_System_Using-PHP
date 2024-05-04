<?php
// Your database connection code here
$conn = new mysqli("localhost", "root", "", "ncas_db");

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;

    // Prepare and execute the SQL statement to delete the event
    $delete_query = "DELETE FROM registrations WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        // The event was successfully deleted
        echo json_encode(['success' => true, 'message' => 'Event deleted successfully']);
    } else {
        // An error occurred during the deletion
        echo json_encode(['success' => false, 'message' => 'Error deleting event']);
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: index.php"); // Change 'index.php' to the appropriate page
    exit();
}
?>
