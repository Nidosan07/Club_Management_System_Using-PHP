

<?php
// Process form data when the form is submitted
$message = $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Process form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $student_id = $_POST['student_id'];
    $club_id = $_POST['club_id'];
    $registrations_id = $_POST['registrations_id'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $gender = $_POST['gender'];

    // Validate form data (add more validation as needed)
    if (empty($name) || empty($email) || empty($phone)) {
        $error_message = "Name, email, and phone are required fields.";
    } else {
        // Insert data into the database using prepared statement
        $stmt = $conn->prepare("INSERT INTO event_registrations (name, email, phone, student_id, club_id, registrations_id, faculty, degree, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisiisss", $name, $email, $phone, $student_id, $club_id, $registrations_id, $faculty, $degree, $gender);

        if ($stmt->execute()) {
            // Registration successful
            $message = "Event registration successful!";
        } else {
            // Registration failed
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 4000px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: green;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        .message {
            color: #4caf50;
            margin-top: 10px;
        }

        .error {
            color: #f44336;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
        if (!empty($message)) {
            echo "<p style='color: green;'>$message</p>";
        }
        if (!empty($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
    ?>
    <h2 style="text-align: center;">Event Registration Form</h2>

    <form action="" id="event-registration-form" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
        <label for="student_id">Student_ID:</label>
        <input type="text" name="student_id" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
        <label for="faculty">Faculty:</label>
        <input type="text" name="faculty" required>
        </div>

        <div class="form-group">
        <label for="degree">Degree:</label>
        <input type="text" name="degree" required>

        </div>

        <div class="form-group">
        <label for="gender">gender:</label>
        <select name="gender" required>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
        </select>
        </div>


        <div class="form-group">
            <label for="club_id">Club Name:</label>
            <select name="club_id" required>
                <?php
                // Fetch club names from the club_list table
                $club_query = "SELECT id, name FROM club_list";
                $club_result = $conn->query($club_query);

                if ($club_result->num_rows > 0) {
                    while ($club_row = $club_result->fetch_assoc()) {
                        echo "<option value='{$club_row['id']}'>{$club_row['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="registrations_id">Event Name:</label>
            <select name="registrations_id" required>
                <?php
                // Fetch registration names from the registrations table
                $registration_query = "SELECT id, name FROM registrations";
                $registration_result = $conn->query($registration_query);

                if ($registration_result->num_rows > 0) {
                    while ($registration_row = $registration_result->fetch_assoc()) {
                        echo "<option value='{$registration_row['id']}'>{$registration_row['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <input type="submit" value="Submit">
    </form>


  

    <?php
    // Display success or error message
    if (!empty($message)) {
        echo '<p class="message">' . $message . '</p>';
    }

    if (!empty($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }
    ?>
</body>
<script>
    // Add your JavaScript code here
    document.getElementById('event-registration-form').addEventListener('submit', function (event) {
        // You can add additional validation or actions here
        console.log('Form submitted!');
    });
</script>
</html>
