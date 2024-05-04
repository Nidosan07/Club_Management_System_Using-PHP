<?php

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $attendees = $_POST['attendees'];
    $event_date = $_POST['event_date'];
    $club_id = $_POST['club_id'];

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

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (name, email, phone, attendees, event_date, club_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisis", $name, $email, $phone, $attendees, $event_date, $club_id, $image);

    if ($stmt->execute()) {
        // Registration successful
        echo("Event Register Sucess!"); // Redirect to a success page
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
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome CSS link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
    <style>
 body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px;
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
                        <label for="email">Event Description <span class="text-primary">*</span></label>
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

                    <div class="form-group">
                        <label for="club_id">Select Club <span class="text-primary">*</span></label>
                        <select name="club_id" id="club_id" class="form-select rounded-0" required>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

