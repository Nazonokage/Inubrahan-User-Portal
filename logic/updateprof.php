<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}

// Database connection
require_once '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = htmlspecialchars($_POST['username']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $new_password = $_POST['new_password'];
    $current_password = $_POST['current_password'];
    
    // Verify current password
    $user_id = $_SESSION['user_id'];
    $verify_sql = "SELECT password FROM user WHERE id = ?";
    $verify_stmt = $conn->prepare($verify_sql);
    $verify_stmt->bind_param("i", $user_id);
    $verify_stmt->execute();
    $result = $verify_stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (md5($current_password) !== $user['password']) {
        $_SESSION['error'] = "Current password is incorrect";
        header("Location: ../profile.php");
        exit;
    }
    
    // Start building the update query
    $updates = array();
    $types = "";
    $params = array();
    
    // Add basic fields
    $updates[] = "username = ?";
    $updates[] = "firstname = ?";
    $updates[] = "lastname = ?";
    $types .= "sss";
    $params[] = $username;
    $params[] = $firstname;
    $params[] = $lastname;
    
    // Handle new password if provided
    if (!empty($new_password)) {
        $updates[] = "password = ?";
        $types .= "s";
        $params[] = md5($new_password);
    }
    
    // Handle profile picture if uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $profile_picture = $_FILES['profile_picture'];
        $upload_dir = '../uploads/';
        $file_extension = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($file_extension, $allowed_extensions)) {
            // Create new filename using user_id and email
            $new_filename = $user_id . '_' . $_SESSION['email'] . '.' . $file_extension;
            $target_path = $upload_dir . $new_filename;
            
            // Remove old profile picture if it exists and is different
            if ($_SESSION['profile_picture'] && 
                $_SESSION['profile_picture'] !== $new_filename && 
                file_exists($upload_dir . $_SESSION['profile_picture'])) {
                unlink($upload_dir . $_SESSION['profile_picture']);
            }
            
            if (move_uploaded_file($profile_picture['tmp_name'], $target_path)) {
                $updates[] = "profile_picture = ?";
                $types .= "s";
                $params[] = $new_filename;
            }
        }
    }
    
    // Add user_id to params
    $types .= "i";
    $params[] = $user_id;
    
    // Prepare and execute update query
    $sql = "UPDATE user SET " . implode(", ", $updates) . " WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    // Create array of references for bind_param
    $refs = array();
    $refs[] = &$types;
    foreach($params as $key => $value) {
        $refs[] = &$params[$key];
    }
    call_user_func_array(array($stmt, 'bind_param'), $refs);
    
    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        
        if (isset($new_filename)) {
            $_SESSION['profile_picture'] = $new_filename;
        }
        
        header("Location: ../welcome.php");
        exit;
    } else {
        $_SESSION['error'] = "Error updating profile: " . $stmt->error;
        header("Location: ../profile.php");
        exit;
    }
    
    $stmt->close();
} else {
    header("Location: ../profile.php");
    exit;
}

$conn->close();
?>