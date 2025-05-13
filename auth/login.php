<!-- Remain -->
<!-- 
1. prepared statements
2.
3.
-->

<?php
session_start();
require_once "../config.php";

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // Validate Input
    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        // Fatch usres by email
        $sql = "SELECT id, username, password FROM users WHERE email = '$email'"; // dont use this because
        // Using variables directly in SQL is dangerous (SQL injection risk). Never put user input directly into queries

        // // First prepare the statement with placeholders
        // $sql = "SELECT id, username, password FROM users WHERE email = ?";
        $result = mysqli_query($conn, $sql);
            
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                // Login succesful:set session variable
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../dashboard.php");
                exit();
            } else {
                $errors[] = "incorect PAssword.";
            }
        } else {
            $errors[] = "Email not found.";
        }
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-4">Login</h3>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" required
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <div class="text-center mt-3">
                            Don't have an account? <a href="register.php">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>