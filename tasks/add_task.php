<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
require_once "../config.php";

// Check if user is Logged in 
if (!isset($_SESSION['username'])) {
    header("location:../auth.login.php");
    exit();
}

// Din't understand this line
$username = $_SESSION['username'];

//  Process from submission 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = trim($_POST['task_name']);

    if (!empty($task_name)) {
        $user_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'"))['id'];

        $sql = "INSERT INTO tasks (user_id, title,  status) VALUES ('$user_id', '$task_name', 'pending')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Somthing went wrong. Please try again.";
        }
    } else {
        $error = "Task name cannot be empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - Daily Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h3 class="card-title">Add Task</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" >
            <div class="mb-3">
                <label class="form-label">Task Name</label>
                <input type="text" name="task_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Task</button>
        </form>

        <a href="../dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

</body>

</html>