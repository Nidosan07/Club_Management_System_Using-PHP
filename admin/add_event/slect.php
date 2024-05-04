<?php
            while ($row = $clubListResult->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
            }
            ?>