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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['username']) && isset($_POST['password']) && 
        isset($_POST['name']) && isset($_POST['middlename']) && 
        isset($_POST['lastname']) && isset($_POST['age'])) {

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO thistable1 (username, password, firstname, middlename, lastname, age) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $username, $password, $firstname, $middlename, $lastname, $age);

        // Set parameters and execute
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password storage
        $firstname = $_POST['name'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];

        if ($stmt->execute()) {
            echo "New record created successfully";
            echo "<div style='text-align: center; margin-top: 10px;'><a href='index.php' style='display:inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>Back to Home</a></div>"; // Centered back button
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
