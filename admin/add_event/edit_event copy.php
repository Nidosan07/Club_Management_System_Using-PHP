<?php
// Your database connection code here
$conn = new mysqli("localhost", "root", "", "ncas_db");

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch event details based on the provided ID
    $select_query = "SELECT * FROM registrations WHERE id = $event_id";
    $result = $conn->query($select_query);

    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();

        // Display the form for editing the event
        // You should customize this form based on your actual form fields
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Edit Event</title>
        </head>
        <body>
            <h2>Edit Event</h2>
            <form action='update_event.php' method='POST'>
                <!-- Your form fields with pre-filled values from the fetched event data -->
                <input type='hidden' name='event_id' value='{$event['id']}'>
                
                <!-- Event Name -->
                <label for='name'>Event Name:</label>
                <input type='text' name='name' value='{$event['name']}' placeholder='Event Name' required>

                <!-- Email -->
                <label for='email'>Email:</label>
                <input type='email' name='email' value='{$event['email']}' placeholder='Event Email' required>

                <!-- Phone -->
                <label for='phone'>Phone:</label>
                <input type='text' name='phone' value='{$event['phone']}' placeholder='Event Phone' required>

                <!-- Attendees -->
                <label for='attendees'>Attendees:</label>
                <input type='number' name='attendees' value='{$event['attendees']}' placeholder='Number of Attendees' required>

                <!-- Add other form fields as needed -->

                <button type='submit'>Update Event</button>
            </form>
        </body>
        </html>";
    } else {
        echo "Event not found.";
    }
} else {
    echo "Event ID not provided.";
}
?>
