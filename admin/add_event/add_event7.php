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
    <form action="process_event.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
        <select  name="club" >
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
<script>
    // JavaScript function for client-side validation
    function validateForm() {
        var name = document.forms["registrationForm"]["name"].value;
        var email = document.forms["registrationForm"]["email"].value;
        var phone = document.forms["registrationForm"]["phone"].value;
        var attendees = document.forms["registrationForm"]["attendees"].value;
        var eventDate = document.forms["registrationForm"]["event_date"].value;
        var club = document.forms["registrationForm"]["club"].value;

        // Add your validation logic here
        if (name == "" || email == "" || phone == "" || attendees == "" || eventDate == "" || club == "") {
            alert("All fields must be filled out");
            return false;
        }

        // You can add more specific validation logic for each field if needed

        return true;
    }
</script>
</html>
