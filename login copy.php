<?php
session_start(); // Start the session at the beginning of your code

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php"); // Change "login.php" to the actual login page file
    exit(); // Stop executing the current script
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $signupStudentId = sanitizeInput($conn, $_POST['signupStudentId']);
    $signupName = sanitizeInput($conn, $_POST['signupName']);
    $signupPassword = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);

    $checkQuery = "SELECT * FROM students WHERE student_id = '$signupStudentId'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Student ID already exists.');</script>";
    } else {
        $insertQuery = "INSERT INTO students (student_id, name, password) VALUES ('$signupStudentId', '$signupName', '$signupPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Signup successful.');</script>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $loginStudentId = sanitizeInput($conn, $_POST['loginStudentId']);
    $loginPassword = $_POST['loginPassword'];

    $retrieveQuery = "SELECT * FROM students WHERE student_id = '$loginStudentId'";
    $result = $conn->query($retrieveQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($loginPassword, $row['password'])) {
            echo "<script>alert('Login successful.');</script>";
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form method="post" id="loginForm">
    <h2>Login</h2>
    <input type="text" name="loginStudentId" placeholder="Student ID" required>
    <input type="password" name="loginPassword" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>

<form method="post" id="signupForm" style="margin-left: 20px;">
    <h2>Signup</h2>
    <input type="text" name="signupStudentId" placeholder="Student ID" required>
    <input type="text" name="signupName" placeholder="Name" required>
    <input type="password" name="signupPassword" placeholder="Password" required>
    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
    <button type="submit" name="signup">Signup</button>
</form>

<script>
    // Your JavaScript code here (if needed)
</script>

</body>
</html>
