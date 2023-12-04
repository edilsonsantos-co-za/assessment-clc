<?php
// Include your database connection file
// Example: include_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate password
    if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/", $password)) {
        die("Password must be at least 8 characters long, contain at least 1 uppercase letter, and at least 1 special character.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into the database
    $pdo = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $username, $hashed_password]);

    // Redirect to a success page or login page
    header("Location: success.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
<h2>User Registration</h2>
<form action="register.php" method="post">
    <label for="first_name">First Name<span style="color: red;">*</span>:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name"><br>

    <label for="username">Username<span style="color: red;">*</span>:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password<span style="color: red;">*</span>:</label>
    <input type="password" name="password" required><br>

    <!-- Add your CAPTCHA implementation here -->

    <input type="submit" value="Register">
</form>
</body>
</html>
