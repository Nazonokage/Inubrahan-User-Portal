<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    <div class="container">
    <form action="logic\hasing.php" method="POST">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" class="bluebtn" value="Login">
                </tr>
        </table>
    </form>
    </div>
    

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles.js"></script>
</body>
</html>
