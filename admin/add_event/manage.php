<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "scas_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $attendees = $_POST['attendees'];
    $event_date = $_POST['event_date'];
    $club_id = $_POST['club_id'];
    $event_id = $_POST['event_id']; // assuming you have a hidden field for event ID

    // Validate form data (add more validation as needed)
    if (empty($name) || empty($email) || empty($phone) || empty($attendees) || empty($event_date) || empty($club_id)) {
        echo "All fields are required.";
        exit();
    }

    // Handle image upload
    $image = ''; // Set a default image path or handle image upload here
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = '../uploads/event_Poster/' . $_FILES['image']['name']; // Adjust the path as needed
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    if (!empty($event_id)) {
        // Update existing event
        $stmt = $conn->prepare("UPDATE registrations SET name=?, email=?, phone=?, attendees=?, event_date=?, club_id=?, image=? WHERE id=?");
        $stmt->bind_param("sssiissi", $name, $email, $phone, $attendees, $event_date, $club_id, $image, $event_id);
    } else {
        // Insert new event
        $stmt = $conn->prepare("INSERT INTO registrations (name, email, phone, attendees, event_date, club_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiiss", $name, $email, $phone, $attendees, $event_date, $club_id, $image);
    }

    if ($stmt->execute()) {
        // Registration successful
        echo("Event Registration Success!"); // Redirect to a success page
        exit();
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch club list for dropdown
$club_result = $conn->query("SELECT id, name FROM club_list WHERE delete_flag = 0");
$clubs = [];
while ($row = $club_result->fetch_assoc()) {
    $clubs[] = $row;
}

// Check if an event ID is provided for editing
$event_id = isset($_GET['edit']) ? $_GET['edit'] : null;

// Fetch event details if editing
$event_details = [];
if (!empty($event_id)) {
    $stmt = $conn->prepare("SELECT * FROM registrations WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event_details = $result->fetch_assoc();
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
            /* background-color: #f4f4f4; */
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
                        <input type="text" id="name" name="name" class="form-control" value="<?= $event_details['name'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Event Description <span class="text-primary">*</span></label>
                        <textarea row="7" type="text" id="email" name="email" class="form-control" required><?= $event_details['email'] ?? '' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="phone">Venue <span class="text-primary">*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?= $event_details['phone'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="attendees">Number of Attendees <span class="text-primary">*</span></label>
                        <input type="number" id="attendees" name="attendees" class="form-control" value="<?= $event_details['attendees'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="event_date">Event Date <span class="text-primary">*</span></label>
                        <input type="date" id="event_date" name="event_date" class="form-control" value="<?= $event_details['event_date'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="club_id">Select Club <span class="text-primary">*</span></label>
                        <select name="club_id" id="club_id" class="form-select rounded-0" required>
                            <?php foreach ($clubs as $club): ?>
                                <option value="<?= $club['id'] ?>" <?= ($event_details['club_id'] ?? '') == $club['id'] ? 'selected' : '' ?>><?= $club['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <input type="hidden" name="event_id" value="<?= $event_details['id'] ?? '' ?>">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn bg-primary bg-gradient btn-sm text-light w-25">
                                <span class="material-icons"><?= !empty($event_details) ? 'edit' : 'save' ?></span>
                                <?= !empty($event_details) ? 'Update' : 'Register' ?>
                            </button>
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
