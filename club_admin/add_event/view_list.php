<?php


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete registration
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM registrations WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration deleted successfully";
        $_SESSION['message_type'] = "danger";
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit function
if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $sql = "SELECT * FROM registrations WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['edit_id'] = $row['id'];
        $_SESSION['edit_name'] = $row['name'];
        $_SESSION['edit_email'] = $row['email'];
        $_SESSION['edit_phone'] = $row['phone'];
        $_SESSION['edit_attendees'] = $row['attendees'];
        $_SESSION['edit_event_date'] = $row['event_date'];
        $_SESSION['edit_club_id'] = $row['club_id'];
        $_SESSION['edit_image'] = $row['image'];
    } else {
        $_SESSION['message'] = "Error editing record: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    
}

// Retrieve registrations
$sql = "SELECT * FROM registrations";
$registrationListResult = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .delete-btn, .edit-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .table-container {
            width: 80%;
            margin: 0 auto;
        }
        .table-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: left;
        }
        .table-row {
            padding: 15px;
        }
        .message {
            padding: 15px;
            color: white;
            border-radius: 4px;
        }
        .danger {
            background-color: #f44336;
        }
        .success {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='message " . $_SESSION['message_type'] . "'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>
    <h2><center>Event Registration List</center></h2>
    <div class="table-container">
        <table>
            <tr class="table-header">
                <th>Name</th>
                <th>Description</th>
                
                <th>Attendees</th>
                <th>Event Date</th>
                <!-- <th>Club</th> -->
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = $registrationListResult->fetch_assoc()) {
                echo "<tr class='table-row'>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
               
                echo "<td>" . $row['attendees'] . "</td>";
                echo "<td>" . $row['event_date'] . "</td>";
                // echo "<td>" . $row['club_id'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' alt='" . $row['name'] . "'></td>";
                echo "<td><form method='post'><input type='hidden' name='delete' value='" . $row['id'] . "'><button type='submit' class='delete-btn'>Delete</button></form></td>";
             
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>