<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>We're glad to have you here. Enjoy your time exploring our site!</p>
    <a href="logout.php">Logout</a>
    </div>
</body>
</html>
