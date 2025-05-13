<?php
session_start();
include '../config.php'; // adjust path as needed

//  Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Step 1: Check if ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Task ID is missing.";
    exit;
}

$id = $_GET['id'];

// Step 2: Handle form submission to update task
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedTitle = mysqli_real_escape_string($conn, $_POST['title']);

    $updateSql = "UPDATE tasks SET title = '$updatedTitle' WHERE id = $id";
    if (mysqli_query($conn, $updateSql)) {
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Failed to update task: " . mysqli_error($conn);
    }
}

// Step 3: Fetch task from DB to prefill form
$sql = "SELECT * FROM tasks WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $task = mysqli_fetch_assoc($result);
} else {
    echo "Task not found.";
    exit;
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
        <h3 class="card-title">Update Task</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Task Name</label>
                <!-- <input type="text" name="title" class="form-control" required> -->
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($task['title']) ?>" required>

            </div>
            <button type="submit" class="btn btn-primary w-100">Update Task</button>
        </form>

        <a href="../dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

</body>

</html>