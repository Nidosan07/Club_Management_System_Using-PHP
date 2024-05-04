<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $deleteId = $_POST['delete'];
        $deleteSql = "DELETE FROM registrations WHERE id = $deleteId";

        if ($conn->query($deleteSql) === TRUE) {
            echo "Record deleted successfully!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Your existing code for registration insertion
    }
}

// Fetch registration data for table view
$registrationListQuery = "SELECT id, name, email, phone, attendees, event_date, club_id, image FROM registrations";
$registrationListResult = $conn->query($registrationListQuery);


if (!$registrationListResult) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>

    <!-- Include Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Registration List Section -->
    <section class="py-4">
        <div class="container">
            <h3 class="fw-bolder text-center mb-4">Event List</h3>

            <!-- Form for handling delete action -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="delete" value="" />

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php while ($row = $registrationListResult->fetch_assoc()) { ?>
                        <div class="col">
                            <div class="card">
                                <img src="<?php echo $row["image"]; ?>" class="card-img-top" alt="Image">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?php echo $row["name"]; ?></b></h5>
                                    <p class="card-text"><?php echo $row["email"]; ?></p><br>
                                    <?php
                                    $clubId = $row["club_id"];
                                    $clubNameQuery = "SELECT name FROM club_list WHERE id = $clubId";
                                    $clubNameResult = $conn->query($clubNameQuery);
                                    $clubName = ($clubNameResult->num_rows > 0) ? $clubNameResult->fetch_assoc()["name"] : "";
                                    ?>
                                    <p class="card-text"><b>Organizing Club: </b><?php echo $clubName ?></p>
                                    <p class="card-text"><b>Venue: </b><?php echo $row["phone"]; ?></p>
                                    <p class="card-text"><small class="text-muted"><b>Event Date: </b><?php echo $row["event_date"]; ?></small></p>

                                  
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </section>



      <!-- Include Bootstrap 5 JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$conn->close();
?>
