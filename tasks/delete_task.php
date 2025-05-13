<?php
session_start();
require_once "../config.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Get task ID safely
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = (int) $_GET['id'];

    // Delete task
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../dashboard.php");  // ✅ CORRECTED header (space removed after colon)
        exit();
    } else {
        echo "Something went wrong. Please try again.";
    }
} else {
    echo "Invalid Task ID.";
}
