<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "data1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Assume connection to the database is already established

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username/email and password from the form
    $username = $_POST['name'];
    $password = $_POST['password'];

    // Fetch the hashed password from the database for the given username
    $stmt = $conn->prepare("SELECT password FROM thistable1 WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch the row containing the user's data
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the entered password against the stored hash
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, user can be logged in
            echo "Login successful!";
            // Proceed with login (e.g., set session variables, redirect, etc.)
        } else {
            // Password is incorrect
            echo "Invalid password.";
        }
    } else {
        // Username not found
        echo "User not found.";
    }

    $stmt->close();
}
?>