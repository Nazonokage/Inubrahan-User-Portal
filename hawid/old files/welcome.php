<html>
<body>


<?php

$name = $_POST["name"];    // Assign the 'name' value from the form to the variable $name
$pass = $_POST["password"];  // Assign the 'email' value from the form to the variable $email
// Database connection details

$servername = "localhost"; // Usually 'localhost' for local server
$username = "root"; // Default username for WAMP is 'root'
$password = ""; // Default password is empty for WAMP
$database = "mydatabased"; // Your database name


// Create connection to MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!<br>";

// Check if the form was submitted



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
 

    // Prepare and execute SQL statement to fetch user details using placeholders
    $stmt = $conn->prepare("SELECT * FROM banko WHERE Username = '" . $name ."' AND Password= '" .  $pass . "'");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Execute the statement
    $stmt->execute();

    // Check for execution errors
    if ($stmt->errno) {
        die("Execution failed: " . $stmt->error);
    }

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the user was found
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        echo "Welcome " . htmlspecialchars($user['username']) . "!<br>";
        echo "Middle Name: " . htmlspecialchars($user['middlename']) . "<br>";
        echo "Last Name: " . htmlspecialchars($user['lastname']) . "<br>";
        echo "Age: " . htmlspecialchars($user['age']) . "<br>";
    } else {
        echo "User not found!";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
</body>
</html>