<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Session timeout after 30 minutes of inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$_SESSION['last_activity'] = time();

// Database connection
require_once 'conn.php'; // Update with your database connection file

// Fetch user details from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT username, firstname, lastname, age, email, profile_picture FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loader.css">
</head>
<body>
    <!-- Loading Animation Container -->
    <div id="loading" class="loading-container">
        <img src="img/mapache-pedro.gif" alt="Loading...">
    </div>
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <div class="container">
        <h1 class="welcome-header">Welcome, <?php echo htmlspecialchars($user['firstname']); ?>!</h1>
        
        <div class="profile-section">
            <img src="uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" 
                 alt="Profile Picture" 
                 class="profile-picture">
            
            <div class="user-info">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
        </div>

        <div class="actions">
            <a href="profile.php" class="bluebtn">Edit Profile</a>
            <a href="logic/logout.php" class="bluebtn">Logout</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles.js"></script>
</body>
</html>
