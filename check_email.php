<?php
require_once 'database.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $database = Database::getInstance();
    $db = $database->conn;

    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    } else {
        echo json_encode(['error' => 'Database error']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
