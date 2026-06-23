<?php
// Start session
session_start();

// Database connection
require_once '../conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = htmlspecialchars($_POST['name']);
    $password = $_POST['password'];
    
    // Hash the password using MD5 to match the registration hash
    $hashed_password = md5($password);
    
    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT id, username, firstname, lastname, email, profile_picture 
            FROM user 
            WHERE username = ? AND password = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['profile_picture'] = $user['profile_picture'];
        
        // Set last activity time for session timeout
        $_SESSION['last_activity'] = time();
        
        // Redirect to welcome page
        header("Location: ../welcome.php");
        exit;
    } else {
        // Invalid credentials
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: ../login.php");
        exit;
    }
    
    // Close statement
    $stmt->close();
} else {
    // If someone tries to access this file directly
    header("Location: ../login.php");
    exit;
}

// Close connection
$conn->close();
?>