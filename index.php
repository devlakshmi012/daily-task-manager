<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Show logout message (if any)
$logout_msg = '';
if (isset($_SESSION['logout_msg'])) {
    $logout_msg = $_SESSION['logout_msg'];
    unset($_SESSION['logout_msg']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daily Task Manager - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .hero {
            background: linear-gradient(135deg,rgb(236, 158, 22), #6610f2);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .section {
            padding: 60px 20px;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Daily Task Manager</a>
            <div>
                <a href="auth/login.php" class="btn btn-outline-light me-2">Login</a>
                <a href="auth/register.php" class="btn btn-light">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero / Welcome Section -->
    <section class="hero">
        <div class="container">
            <?php if (!empty($logout_msg)): ?>
                <div class="alert alert-success bg-light text-dark mt-2"><?= $logout_msg ?></div>
            <?php endif; ?>
            <h1 class="display-4">Welcome to Daily Task Manager</h1>
            <p class="lead">Organize your tasks, boost your productivity, and stay on top of your day.</p>
            <a href="auth/register.php" class="btn btn-light btn-lg mt-3">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section bg-white">
        <div class="container text-center">
            <h2 class="mb-4">Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>✅ Easy Task Creation</h4>
                    <p>Create, update, and delete your daily tasks in seconds.</p>
                </div>
                <div class="col-md-4">
                    <h4>📅 Status Tracking</h4>
                    <p>Track pending and completed tasks in a simple interface.</p>
                </div>
                <div class="col-md-4">
                    <h4>🔒 Secure Access</h4>
                    <p>Your data is safe with secure login and session management.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section bg-light">
        <div class="container text-center">
            <h2 class="mb-4">About</h2>
            <p class="lead">Daily Task Manager is a lightweight, user-friendly web app built using PHP and MySQL, designed to help individuals keep track of their daily goals and productivity with ease.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section bg-white">
        <div class="container text-center">
            <h2 class="mb-4">Contact Us</h2>
            <p>If you have any questions or feedback, feel free to reach out:</p>
            <p>Email: <a href="mailto:support@taskmanager.com">support@taskmanager.com</a></p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; <?= date('Y') ?> Daily Task Manager. All rights reserved.
        </div>
    </footer>

</body>

</html>