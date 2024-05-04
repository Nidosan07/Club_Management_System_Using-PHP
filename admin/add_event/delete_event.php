<?php
// Your database connection code here
function deleteEvent($eventId) {
    // Your database connection code here
    $conn = new mysqli("localhost", "root", "", "ncas_db");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input to prevent SQL injection
    $eventId = $conn->real_escape_string($eventId);

    // Perform the deletion
    $deleteQuery = "DELETE * FROM registrations WHERE id = $eventId";

    if ($conn->query($deleteQuery) === TRUE) {
        // Deletion successful
        echo json_encode(array('status' => 'success', 'message' => 'Event deleted successfully'));
    } else {
        // Error in deletion
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting event: ' . $conn->error));
    }

    // Close the database connection
    $conn->close();
}

// Handle form submission for event deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['event_id'])) {
        $eventId = $_POST['event_id'];
        deleteEvent($eventId);
    }
}

?>
