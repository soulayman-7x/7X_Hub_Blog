<?php
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/User.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $user = new User($db);
            if ($user->register($username, $email, $password)) {
                $message = "<div class='msg-box success'>Protocol Success: Account created successfully.</div>";
            } else {
                $message = "<div class='msg-box error'>System Error: Email already exists.</div>";
            }
        } else {
            $message = "<div class='msg-box error'>Critical Error: Database connection failed.</div>";
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
    <title>7X CORE // Initialization</title>

    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/auth.css">
</head>

<body class="auth-page">

    <div class="auth-card">
        <img src="<?php echo BASE_URL; ?>assets/images/logo/x-core-v1-wh.png" alt="7X hub" class="auth-logo">

        <h2 class="auth-title gradient-text">Initialize Protocol</h2>

        <?php echo $message; ?>

        <form action="register.php" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off" placeholder="e.g. Neo_7X">
            </div>

            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" required autocomplete="off" placeholder="user@domain.com">
            </div>

            <div class="input-group">
                <label>Security Key</label>
                <input type="password" name="password" required placeholder="Create a strong password">
            </div>

            <button type="submit" class="auth-btn auth-btn-large" style="margin-top: 10px;">Execute Protocol</button>
        </form>

        <div style="text-align: center; margin-top: 24px; font-size: 13px; color: var(--text-secondary);">
            Already integrated? <a href="login.php">Access System</a>
        </div>
    </div>

</body>

</html>