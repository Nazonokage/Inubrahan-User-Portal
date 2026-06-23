<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- Registration Container -->
    <div class="container" style="display: none;">
        <h1>Register</h1>
        <form action="logic/register.php" method="POST" enctype="multipart/form-data">
            <table>
                <!-- Email Field -->
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <!-- Username Field -->
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <!-- Password Field -->
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <!-- First Name Field -->
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="firstname" required></td>
                </tr>
                <!-- Middle Name Field -->
                <tr>
                    <td>Middle Name:</td>
                    <td><input type="text" name="middlename"></td>
                </tr>
                <!-- Last Name Field -->
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="lastname" required></td>
                </tr>
                <!-- Age Field -->
                <tr>
                    <td>Age:</td>
                    <td><input type="number" name="age" min="0" required></td>
                </tr>
                <!-- Profile Picture Upload -->
                <tr>
                    <td>Profile Picture:</td>
                    <td><input type="file" name="profile_picture" accept="image/*" required></td>
                </tr>
                <!-- Submit Button -->
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" class="bluebtn">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles.js"></script>
    <script src="js/loader.js"></script>
</body>
</html>
