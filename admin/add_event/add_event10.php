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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            /* max-width: 1000px; */
            align-items: center;
            /* margin: 50px 50px 50px 50px; */
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
    </style>
</head>
<body>
    <h2><center>Event Registration</center></h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name*:</label>
        <input type="text" name="name" required>

        <label for="email">Description*:</label>
        <input type="text" name="email" required>

        <label for="phone">Venue*:</label>
        <input type="text" name="phone" required>

        <label for="attendees">Number of Attendees*:</label>
        <input type="number" name="attendees" required>

        <label for="event_date">Event Date*:</label>
        <input type="date" name="event_date" required>

        <label for="club">Select Club*:</label>
        <select name="club" required>
            <?php
            while ($row = $clubListResult->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select>

        <label for="image">Upload Image:</label>
        <input type="file" name="image">

        <button type="submit">Submit</button>
    </form>
</body>
</html>
