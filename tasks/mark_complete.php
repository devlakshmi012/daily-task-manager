<?php
require_once "../config.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if task ID is provided and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $task_id = (int) $_GET['id'];

    // Make sure the task belongs to the logged-in user
    $check_sql = "SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) === 1) {
        // Update the task to mark it completed
        $update_sql = "UPDATE tasks SET status = 'completed' WHERE id = $task_id";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Something went wrong while updating.";
        }
    } else {
        echo "Invalid task ID or you don't have permission to update this task.";
    }
} else {
    echo "Invalid task ID.";
}
?>

