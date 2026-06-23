<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
require_once 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js"></script>

</head>
<body>
    <!-- Loading Animation Container -->
    <div id="loading" class="loading-container">
        <img src="img/mapache-pedro.gif" alt="Loading...">
    </div>
    
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <div class="container" style="margin-top: 150px;">
        <h1 class="edit-header">Edit Profile</h1>

        <div class="current-profile">
            <img src="uploads/<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" 
                 alt="Profile Picture" 
                 class="profile-picture">
            <div class="current-email">
                Current Email: <?php echo htmlspecialchars($_SESSION['email']); ?>
            </div>
        </div>

        <form action="logic/updateprof.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" 
                       value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" 
                       value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" 
                       value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password (leave blank to keep current):</label>
                <input type="password" name="new_password" id="new_password">
            </div>

            <div class="form-group">
                <label for="profile_picture">New Profile Picture (optional):</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            </div>

            <div class="form-group">
                <label for="current_password">Current Password (required to save changes):</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>

            <div class="button-group">
                <a href="welcome.php" class="bluebtn">Cancel</a>
                <input type="submit" value="Save Changes" class="bluebtn">
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles.js"></script>
    <script>
    // Display loading animation for 3 seconds before showing the login form
    document.addEventListener('DOMContentLoaded', function () {
        const loading = document.getElementById('loading');
        const container = document.querySelector('.container');

        loading.style.display = 'flex';

        setTimeout(() => {
            loading.style.display = 'none';
            container.style.display = 'block';
        }, 3000);
    });
    </script>
</body>
</html>