<?php
$message = $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ncas_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $student_id = $_POST['student_id'];
    // $club_id = $_POST['club_id'];
    // $registrations_id = $_POST['registrations_id'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $gender = $_POST['gender'];

    if (empty($name) || empty($email) || empty($phone)) {
        $error_message = "Name, email, and phone are required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO event_registrations (name, email, phone, student_id, club_id, registrations_id, faculty, degree, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisiisss", $name, $email, $phone, $student_id, $club_id, $registrations_id, $faculty, $degree, $gender);

        if ($stmt->execute()) {
            $message = "Event registration successful!";
        } else {
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if (!empty($message)) {
                echo "<div class='alert alert-success'>$message</div>";
            }
            if (!empty($error_message)) {
                echo "<div class='alert alert-danger'>$error_message</div>";
            }
            ?>
            <h2 class="text-center">Event Registration Form</h2>
            <form action="" id="event-registration-form" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="student_id" class="form-label">Student_ID:</label>
                    <input type="text" name="student_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="faculty" class="form-label">Faculty:</label>
                    <input type="text" name="faculty" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="degree" class="form-label">Degree:</label>
                    <input type="text" name="degree" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>

                <!-- <div class="mb-3">
                    <label for="club_id" class="form-label">Club Name:</label>
                    <select name="club_id" class="form-select" required>
                        <?php
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

                <div class="mb-3">
                    <label for="registrations_id" class="form-label">Event Name:</label>
                    <select name="registrations_id" class="form-select" required>
                        <?php
                        $registration_query = "SELECT id, name FROM registrations";
                        $registration_result = $conn->query($registration_query);

                        if ($registration_result->num_rows > 0) {
                            while ($registration_row = $registration_result->fetch_assoc()) {
                                echo "<option value='{$registration_row['id']}'>{$registration_row['name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div> -->

                <div class="mb-3">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('event-registration-form').addEventListener('submit', function (event) {
        var name = document.getElementsByName('name')[0].value;
        var email = document.getElementsByName('email')[0].value;
        var phone = document.getElementsByName('phone')[0].value;

        if (name.trim() === '' || email.trim() === '' || phone.trim() === '') {
            alert('Name, email, and phone are required fields.');
            event.preventDefault();
        }
    });
</script>
</body>
</html>
