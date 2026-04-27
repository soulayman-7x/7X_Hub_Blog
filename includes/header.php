<?php 
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <a href="index.php" class="site-logo">
                <img src="assets/images/logo/X-Core-V1.png" alt="7X-Hub logo">
                7X Hub<span>_</span>
            </a>
            <div class="nav-links">
                <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>"><i class="fa-solid fa-house-chimney"></i> Home</a>
                <a href="contact.php" class="<?= ($currentPage == 'contact.php') ? 'active' : '' ?>"><i class="fa-solid fa-satellite-dish"></i> Contact</a>

                <?php if ($isLoggedIn): ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="Admin/dashboard.php" style="color: var(--color-7x-cyan); text-shadow: var(--glow-cyan);">
                            <i class="fa-solid fa-shield-halved"></i> Command Center
                        </a>
                    <?php endif; ?>

                    <span style="color: var(--color-7x-blue); font-family: var(--font-mono); font-size: 13px;">
                        <i class="fa-solid fa-user-astronaut"></i> @<?= $username ?>
                    </span>
                    <a href="logout.php" class="auth-btn"><i class="fa-solid fa-power-off"></i> Disconnect</a>

                <?php else: ?>
                    <a href="login.php"><i class="fa-solid fa-fingerprint"></i> Login</a>
                    <a href="register.php" class="auth-btn"><i class="fa-solid fa-terminal"></i> Initialize</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>