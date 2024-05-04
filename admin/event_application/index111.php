<?php
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

// Handle delete for event heading
if (isset($_GET['delete_event'])) {
    $eventNameToDelete = $_GET['delete_event'];

    // Delete event and associated registrations
    $deleteEventSql = "DELETE FROM registrations WHERE name = '$eventNameToDelete'";
    $deleteEventResult = $conn->query($deleteEventSql);

    if ($deleteEventResult) {
        echo "Event '$eventNameToDelete' and associated registrations deleted successfully.";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}

// Handle delete for individual applications
if (isset($_GET['delete_application'])) {
    $applicationIdToDelete = $_GET['delete_application'];

    // Delete individual application
    $deleteApplicationSql = "DELETE FROM event_registrations WHERE id = $applicationIdToDelete";
    $deleteApplicationResult = $conn->query($deleteApplicationSql);

    if ($deleteApplicationResult) {
        echo "Application $applicationIdToDelete deleted successfully.";
    } else {
        echo "Error deleting application: " . $conn->error;
    }
}

// Retrieve event registrations data from the database
$sql = "SELECT * FROM event_registrations";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Apllications</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: lightgray;
        }

        .delete-button {
            background-color: #ff4d4d;
            width: 150px;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Event Registrations</h2>

    <?php
    if ($result->num_rows > 0) {
        $currentEventName = null;
        $applicationNumber = 1;

        while ($row = $result->fetch_assoc()) {
            // Fetch club name using club ID
            $clubId = $row['club_id'];
            $clubSql = "SELECT name FROM club_list WHERE id = '$clubId'";
            $clubResult = $conn->query($clubSql);
            $clubName = ($clubResult->num_rows > 0) ? $clubResult->fetch_assoc()['name'] : '';

            // Fetch event name using registration ID
            $registrationId = $row['registrations_id'];
            $eventSql = "SELECT name FROM registrations WHERE id = '$registrationId'";
            $eventResult = $conn->query($eventSql);
            $eventName = ($eventResult->num_rows > 0) ? $eventResult->fetch_assoc()['name'] : '';

            // Check if the event name has changed
            if ($eventName != $currentEventName) {
                // If it has changed, start a new section in the table
                if ($currentEventName !== null) {
                    echo "</table>"; // Close the previous table
                    echo "<br><br>";
                    $applicationNumber = 1; // Reset application number for the new event
                }

                // Start a new table for the current event name
                echo "<h3><center>$eventName</center></h3>";
                echo "<table>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                echo "<th>Student ID</th>";
                echo "<th>Faculty</th>";
                echo "<th>Degree</th>";
                echo "<th>Gender</th>";
                echo "<th>Club Name</th>";
                echo "<th>Action</th>";
                echo "</tr> ";

                $currentEventName = $eventName;
            }

            // Display the data in the table, including delete button for each application
            echo "<tr>";
            echo "<td>" . $applicationNumber . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['student_id'] . "</td>";
            echo "<td>" . $row['faculty'] . "</td>";
            echo "<td>" . $row['degree'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $clubName . "</td>";
            echo "<td><button class='delete-button' onclick=\"window.location='?delete_application=" . $row['id'] . "'\">Delete</button></td>";
            echo "</tr>";

            $applicationNumber++;
        }

        // Close the last table
        echo "</table>";

        // Add delete button for the last event if any
    } else {
        echo "<p>No event registrations found.</p>";
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
