<?php
require_once "config.php";
session_start();
//  Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$username = $_SESSION['username']; // Set during login
$user_id = $_SESSION['user_id'];

// Fetch tasks from database
$sql = "SELECT * FROM tasks WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Daily Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h3 class="card-title">Welcome, <?= htmlspecialchars($username) ?>!</h3>

        <a href="tasks/add_task.php" class="btn btn-primary mb-3">Add Task</a>

        <!-- Task Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td>
                            <?php if (trim(strtolower($task['status'])) === 'completed'): ?>
                                <span class="badge bg-success">Completed</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="tasks/edit_task.php?id=<?= $task['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="tasks/delete_task.php?id=<?= $task['id'] ?>" onclick="return confirm('Are you sure you want to delete this task?');" class="btn btn-danger">Delete</a>
                            <?php if ($task['status'] != 'completed'): ?>
                                <a href="tasks/mark_complete.php?id=<?= $task['id'] ?>" class="btn btn-success">Mark as Completed</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="auth/logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

</body>

</html>