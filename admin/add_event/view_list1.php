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

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $deleteId = $_POST['delete'];
        $deleteSql = "DELETE FROM registrations WHERE id = $deleteId";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Record deleted successfully!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
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
}

// Fetch registration data for table view
$registrationListQuery = "SELECT id, name, email, phone, attendees, event_date, club_id, image FROM registrations";
$registrationListResult = $conn->query($registrationListQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form and List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form, table {
            width: 50%;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>


    <h2><center>Registration List</center></h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Attendees</th>
            <th>Event Date</th>
            <th>Club</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $registrationListResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["attendees"] . "</td>";
            echo "<td>" . $row["event_date"] . "</td>";

            // Fetch club name based on club_id
            $clubId = $row["club_id"];
            $clubNameQuery = "SELECT name FROM club_list WHERE id = $clubId";
            $clubNameResult = $conn->query($clubNameQuery);
            $clubName = ($clubNameResult->num_rows > 0) ? $clubNameResult->fetch_assoc()["name"] : "";

            echo "<td>" . $clubName . "</td>";

            echo "<td><img src='" . $row["image"] . "' alt='Image' style='max-width:100px; max-height:100px;'></td>";

            // Delete button with a form for each entry
            echo "<td><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><button type='submit' name='delete' value='" . $row["id"] . "' class='delete-btn'>Delete</button></form></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
