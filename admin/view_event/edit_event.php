<?php

// Your database connection code here
$conn = new mysqli("localhost", "root", "", "ncas_db");

// Fetch event details for editing
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `registrations` WHERE id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your form handling code here
    // ...

    // For example, you can update the database with the new values
    $id = $_POST['id'];
    $status = $_POST['status'];
    $event_name = $_POST['event_name'];
    // Update other fields as needed

    $update_query = "UPDATE `registrations` SET status='$status', event_name='$event_name' WHERE id='$id'";
    if ($conn->query($update_query)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
        $response['msg'] = 'Failed to update event';
    }

    echo json_encode($response);
    exit();
}

// Fetch club list for dropdown
$club_result = $conn->query("SELECT id, name FROM club_list WHERE delete_flag = 0");
$clubs = [];
while ($row = $club_result->fetch_assoc()) {
    $clubs[$row['id']] = $row['name']; // Store club names in an associative array with club IDs as keys
}

// Fetch registered events
$events_result = $conn->query("SELECT * FROM registrations");
$events = [];
while ($row = $events_result->fetch_assoc()) {
    $row['club_name'] = $clubs[$row['club_id']]; // Add club name to the events array
    $events[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy4iDRyueYb1owStgM89+OZn3luIaaLNo"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy4iDRyueYb1owStgM89+OZn3luIaaLNo"
        crossorigin="anonymous"></script>

    <!-- Add DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <style>
        /* Your custom styles here */
    </style>
</head>

<body>

    <div class="container-fluid">
        <form action="" id="event-form" class="py-3">
            <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">

            <div class="form-group">
                <label for="status" class="form-label">Status <span class="text-primary">*</span></label>
                <select name="status" id="status" class="form-select rounded-0" required>
                    <option class="px-2 py-2" value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Pending
                    </option>
                    <option class="px-2 py-2" value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Confirmed
                    </option>
                    <option class="px-2 py-2" value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>Approved
                    </option>
                    <option class="px-2 py-2" value="3" <?= isset($status) && $status == 3 ? 'selected' : '' ?>>Denied
                    </option>
                </select>
            </div>

            <!-- Add other form fields for event details -->
            <div class="form-group">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" name="event_name" id="event_name" class="form-control"
                    value="<?= isset($event_name) ? $event_name : '' ?>" required>
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Save Event</button>
        </form>
    </div>

    <script>
        $(function () {
            $('#event-form').submit(function (e) {
                e.preventDefault();
                $('.pop-alert').remove();
                var _this = $(this);
                var el = $('<div>');
                el.addClass("pop-alert alert alert-danger text-light");
                el.hide();
                start_loader();
                $.ajax({
                    url: '../classes/Master.php?f=save_event', // Replace with the actual filename
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(_this[0]),
                    dataType: 'json',
                    error: function (err) {
                        console.error(err);
                        el.text("An error occurred while saving data");
                        _this.prepend(el);
                        el.show('slow');
                        $('html, body').scrollTop(_this.offset().top - '150');
                        end_loader();
                    },
                    success: function (resp) {
                        if (resp.status == 'success') {
                            location.reload();
                        } else if (!!resp.msg) {
                            el.text(resp.msg);
                            _this.prepend(el);
                            el.show('slow');
                            $('html, body').scrollTop(_this.offset().top - '150');
                        } else {
                            el.text("An error occurred while saving data");
                            _this.prepend(el);
                            el.show('slow');
                            $('html, body').scrollTop(_this.offset().top - '150');
                        }
                        end_loader();
                    }
                });
            });
        });
    </script>

</body>

</html>
