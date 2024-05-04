<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>

    <!-- Add DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        body{
            font-family: 'Arial', sans-serif;

            margin: 0;
            padding: 0;
        }

        .container{
            margin-top: 50px;
        }

        h2{
            color: #343a40;
        }

        hr{
            background-color: #007bff;
            height: 2px;
            border: none;
            margin: 20px 0;
        }

        .btn{
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        td{
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th{
            background-color: lightgray;
        }

        img{
            max-width: 200px;
            height: auto;
            border-radius: 4px;
        }

        .btn-primary{
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-danger{
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Your database connection code here
$conn = new mysqli("localhost", "root", "", "ncas_db");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your form handling code here

    // ...

    // Delete the event
    if (isset($_POST['delete_event_id'])) {
        $eventId = $_POST['delete_event_id'];
        $sql = "DELETE FROM registrations WHERE id=$eventId";
        $conn->query($sql);
    }
}

// Fetch club list for dropdown
$clubResult = $conn->query("SELECT id, name FROM club_list WHERE delete_flag = 0");
$clubs = [];
while ($row = $clubResult->fetch_assoc()) {
    $clubs[$row['id']] = $row['name']; // Store club names in an associative array with club IDs as keys
}

// Fetch registered events
$eventsResult = $conn->query("SELECT * FROM registrations");
$events = [];
while ($row = $eventsResult->fetch_assoc()) {
    $row['club_name'] = $clubs[$row['club_id']]; // Add club name to the events array
    $events[] = $row;
}
?>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bolder text-center"><b>Event List</b></h2>
        <hr>
        <div >
            <div >

                <!-- Display registered events -->
                <table id="eventTable" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Attendees</th>
                            <th>Event Date</th>
                            <th>Club</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?= $event['name'] ?></td>
                                <td><?= $event['email'] ?></td>
                                <td><?= $event['attendees'] ?></td>
                                <td><?= $event['event_date'] ?></td>
                                <td><?= $event['club_name'] ?></td>
                                <td><img src="<?= $event['image'] ?>" alt="Event Image"></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="delete_event_id" value="<?= $event['id'] ?>">
                                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- DataTables initialization script -->
<script>
    $(document).ready(function() {
        $('#eventTable').DataTable();
    });
</script>

</body>
</html>