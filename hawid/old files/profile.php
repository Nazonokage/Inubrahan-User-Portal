<?php
session_start();
$servername = "localhost";  // Your database server
$db_username = "root";       // Your database username
$db_password = "";           // Your database password
$database = "data1";         // Your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: Hasing.php");
    exit();
}

$username = $_SESSION['username'];
$message = "";

// Fetch user data 
$stmt = $conn->prepare("SELECT name, email, profile_picture FROM thistable1 WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->bind_result($name, $email, $profile_picture);
if (!$stmt->fetch()) {
    die("Fetch failed: " . $stmt->error);
}

$stmt->close();


// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_picture = $target_file;
    }

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, profile_picture = ? WHERE username = ?");
    $stmt->bind_param("ssss", $name, $email, $profile_picture, $username);
    
    if ($stmt->execute()) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212; /* Dark background */
            color: #e0e0e0; /* Light text color */
            margin: 0;
            padding: 20px;
        }

        .profile-container {
            max-width: 500px; /* Adjust the max width */
            margin: 0 auto; /* Center the container */
            padding: 30px; /* Add padding inside the container */
            background: #1e1e1e; /* Darker box background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Subtle shadow */
        }

        h2 {
            color: #ffffff; /* White text color for heading */
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Space below the heading */
        }

        p {
            text-align: center; /* Center the message */
            color: #b0b0b0; /* Lighter grey for the message */
            margin-bottom: 20px; /* Space below the message */
        }

        form {
            display: flex; /* Use flexbox for the form */
            flex-direction: column; /* Stack items vertically */
        }

        label {
            margin: 10px 0 5px; /* Spacing for labels */
            font-weight: bold; /* Bold labels */
            color: #ffffff; /* White color for labels */
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            padding: 12px; /* Padding inside inputs */
            border: 1px solid #444; /* Dark border */
            border-radius: 5px; /* Rounded corners */
            margin-bottom: 15px; /* Space below inputs */
            font-size: 14px; /* Font size for inputs */
            background-color: #2b2b2b; /* Darker background for inputs */
            color: #e0e0e0; /* Light text for inputs */
        }

        button {
            padding: 12px; /* Padding inside the button */
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size for button */
            transition: background-color 0.3s ease; /* Smooth background transition */
        }

        button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        img {
            display: block; /* Block display for the image */
            margin: 15px auto; /* Center the image */
            border-radius: 50%; /* Circular image */
            max-width: 100px; /* Max width for the image */
            height: auto; /* Keep aspect ratio */
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p><?php echo $message; ?></p>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture">
            
            <?php if ($profile_picture): ?>
                <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="100">
            <?php endif; ?>
            
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
