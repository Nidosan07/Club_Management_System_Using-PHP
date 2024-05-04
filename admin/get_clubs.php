<?php
// Assuming $clubListResult is available from your database query
while ($row = $clubListResult->fetch_assoc()) {
    echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
?>
