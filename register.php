<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: welcome.php');
    exit();
}
require 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $confirmPassword = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirmPassword)) {
        if ($password === $confirmPassword) {
            $user = new User();
            $result = $user->register($username, $email, $password);

            if ($result) {
                $_SESSION['username'] = $username;
                header('Location: welcome.php');
                exit();
            } else {
                echo "Registration failed. Username or email may already be taken.";
            }
        } else {
            echo "Passwords do not match.";
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
    <title>Register yourself</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST" id="register-form">
            <h1>Register Your Profile!</h1>
            <label for="user-name"> User Name</label><br>
             <input type="text" id="uname" name="uname" size="50" placeholder="Enter your name"  title="User-Name"><br>
             <label for="register-email"> Email</label><br>
             <input type="email" id="register-email" name="register-email" size="50" placeholder="abc@gmail.com" title="Enter valid email" required><br>
             <label for="password"> Password</label><br>
             <input type="password" id="register-password" name="register-password" size="50" placeholder="password must be 8 character" required><br>
             <label for="confirm-password" > Confirm password</label><br>
             <input type="password" id="register-confirm-password" name="password" size="50" placeholder="Re-enter password" required><br>
             <button type="submit" title="click to Register">Register</button>
             <label for="password">Have an account</label><br>
             <button type="submit" onclick="location.href='login.php'" title="click to submit" >Login</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>