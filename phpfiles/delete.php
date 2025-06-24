<?php
session_start();
include('./phpfiles/connection.php'); // Your DB connection

// Check if user is logged in via session or cookie
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} elseif (isset($_COOKIE['userId'])) {
    $userId = $_COOKIE['userId'];
} else {
    // No userId found, redirect to login
    header("Location: index.php");
    exit;
}

// Prepare and execute DELETE query securely
$stmt = $conn->prepare("DELETE FROM users_data WHERE userId = ?");
$stmt->bind_param("s", $userId);

if ($stmt->execute()) {
    // Clean up session and cookies after deletion
    $stmt->close();
    $conn->close();

    // Destroy session
    session_unset();
    session_destroy();

    // Clear cookie
    setcookie('userId', '', time() - 3600, "/");

    // Redirect to login page
    header("Location: index.php");
    exit;
} else {
    $stmt->close();
    $conn->close();
    // Handle error (optional)
    echo "Error deleting user. Please try again.";
    exit;
}
?>
