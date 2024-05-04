<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "ncas_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in

if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Fetch user information including the club ID
    $sql = "SELECT u.*, c.club_name FROM users u
            INNER JOIN club_list c ON u.club_id = c.club_id
            WHERE u.user_id = $user_id";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, fetch the club information
        $row = mysqli_fetch_assoc($result);
        $club_id = $row['club_id'];
        $club_name = $row['club_name'];

    } else {
        // User not found or an error occurred
        
        exit();
    }
}
// You can add an else condition here if you want to handle the case where the user is not logged in, but without redirection




// Check if the user is a club admin (you need to implement your authentication logic here)
$isClubAdmin = true; // Set this based on your authentication logic

// Set the default club_id for the club admin (replace 1 with the actual club ID for the admin)
$club_id_for_admin = ($isClubAdmin) ? 1 : null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $attendees = $_POST['attendees'];
    $event_date = $_POST['event_date'];
    $club_id = $club_id_for_admin; // Use the club_id_for_admin for the club admin

    // Validate form data (add more validation as needed)
    if (empty($name) || empty($email) || empty($phone) || empty($attendees) || empty($event_date) || empty($club_id)) {
        echo "All fields are required.";
        exit();
    }


    // Handle image upload
    $image = ''; // Set a default image path or handle image upload here
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = '../uploads/event_Poster/' . $_FILES['image']['name']; 
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (name, email, phone, attendees, event_date, club_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisis", $name, $email, $phone, $attendees, $event_date, $club_id, $image);

    if ($stmt->execute()) {
        // Registration successful
        echo("Event Register Success!"); // Redirect to a success page
        exit();
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b>Create Event Registration</b></h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                <form action="" method="POST" class="py-3" enctype="multipart/form-data" id="event-registration-form">
                    <div class="form-group">
                        <label for="name">Name <span class="text-primary">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Event Description <span class="text-primary">*</span></label>
                        <textarea row="7" type="text" id="email" name="email" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="phone">Venue <span class="text-primary">*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="attendees">Number of Attendees <span class="text-primary">*</span></label>
                        <input type="number" id="attendees" name="attendees" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="event_date">Event Date <span class="text-primary">*</span></label>
                        <input type="date" id="event_date" name="event_date" class="form-control" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="club_id">Club Name <span class="text-primary">*</span></label>
                        <input type="text" id="club_id" name="club_id" class="form-control" value="<?= $club_name ?>" readonly>
                    </div> -->

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25"><span class="material-icons">save</span> Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Add your JavaScript code here
    document.getElementById('event-registration-form').addEventListener('submit', function (event) {
        // You can add additional validation or actions here
        console.log('Form submitted!');
    });
</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>