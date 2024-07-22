<?php
session_start();
require 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $user = new User();
        $result = $user->login($email, $password);

        if ($result) {
            $_SESSION['username'] = $result;
            header('Location: welcome.php');
            exit();
        } else {
            echo "Login failed. Incorrect username/email or password.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST" id="login-form">
            <h1>Sign In to Your Account</h1>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="login-email" placeholder="Enter your email here!" size="50" required ><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="login-password" placeholder="Enter password" size="50" required><br>
            <button type="submit" title="click to submit" >Submit</button>
            <label for="password">Don't have an account</label><br>
            <button type="submit" onclick="location.href='register.php'" title="click to submit" >Register</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
