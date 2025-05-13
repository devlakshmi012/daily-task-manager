<?php
// Get input from user
$user_input = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html>

<head>
    <title>XSS Demo</title>
</head>

<body>
    <h2>XSS Attack Demo</h2>

    <form method="get">
        <label>Enter Message:</label>
        <input type="text" name="msg" placeholder="Try typing: <script>alert('XSS')</script>" style="width:400px;">
        <button type="submit">Submit</button>
    </form>

    <hr>

    <h3>❌ Vulnerable Output (No htmlspecialchars):</h3>
    <div style="border: 1px solid red; padding:10px;">
        <?php
        // Dangerous: Directly printing user input
        echo $user_input;
        ?>
    </div>

    <h3>✅ Secure Output (With htmlspecialchars):</h3>
    <div style="border: 1px solid green; padding:10px;">
        <?php
        // Safe: Converting special characters
        echo htmlspecialchars($user_input);
        ?>
    </div>
</body>

</html>