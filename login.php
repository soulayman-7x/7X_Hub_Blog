<?php
session_start();
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/User.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $user = new User($db);
            $loggedInUser = $user->login($email, $password);

            if ($loggedInUser) {
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['username'] = $loggedInUser['username'];
                $_SESSION['role'] = $loggedInUser['role'];
                if ($_SESSION['role'] == 'admin') {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $message = "<div class='msg-box error'>Access Denied: Invalid credentials.</div>";
            }
        } else {
            $message = "<div class='msg-box error'>System Error: Database connection failed.</div>";
        }
    } else {
        $message = "<div class='msg-box error'>Validation Error: All fields are required.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X Hub // Secure Login</title>

    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/auth.css">
</head>

<body class="auth-page">

    <div class="auth-card">
        <img src="<?php echo BASE_URL; ?>assets/images/logo/x-core-v1-wh.png" alt="7X hub" class="auth-logo">

        <h2 class="auth-title gradient-text">System Access</h2>

        <?php echo $message; ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" required autocomplete="email" placeholder="your@ex.com">
            </div>

            <div class="input-group">
                <label>Security Key</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="auth-btn auth-btn-large" style="margin-top: 10px;">Authenticate</button>
        </form>

        <div style="text-align: center; margin-top: 24px; font-size: 13px; color: var(--text-secondary);">
            No access clearance? <a href="register.php">Initialize Account</a>
        </div>
    </div>

</body>

</html>