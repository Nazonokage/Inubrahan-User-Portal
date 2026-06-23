<?php
// Database connection
require_once '../conn.php'; // Ensure this points to your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);

    // Hash the password using MD5 (note: MD5 is generally not recommended for secure password storage)
    $hashed_password = md5($password);

    // Handle profile picture upload
    $profile_picture = $_FILES['profile_picture'];
    $upload_dir = '../uploads/';
    $file_extension = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Check if upload directory exists, if not create it
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Validate file extension
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Invalid file type. Allowed types: " . implode(', ', $allowed_extensions);
        exit;
    }

    // First, insert user data without the profile picture
    $sql = "INSERT INTO user (email, username, password, firstname, lastname, age) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $email, $username, $hashed_password, $firstname, $lastname, $age);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted user
        $user_id = $conn->insert_id;
        
        // Create the new filename using user_id and email
        $new_filename = $user_id . '_' . $email . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;

        // Move the uploaded file with the new name
        if (move_uploaded_file($profile_picture['tmp_name'], $target_path)) {
            // Update the user record with the profile picture filename
            $update_sql = "UPDATE user SET profile_picture = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_filename, $user_id);
            
            if ($update_stmt->execute()) {
                header("Location: ../login.php"); // Redirect to login page after successful registration
                exit;
            } else {
                echo "Error updating profile picture in database: " . $update_stmt->error;
                // You might want to delete the uploaded file here if the database update fails
                unlink($target_path);
            }
            $update_stmt->close();
        } else {
            echo "Error uploading file.";
            // You might want to delete the user record here if the file upload fails
            $delete_sql = "DELETE FROM user WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("i", $user_id);
            $delete_stmt->execute();
            $delete_stmt->close();
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>