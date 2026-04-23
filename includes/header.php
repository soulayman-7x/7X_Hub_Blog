    <!-- Header -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <a href="index.php" class="site-logo">
                    <img src="assets/images/logo/X-Core-V1.png" alt="7X-Hub logo">
                    7X Hub<span>_</span>
                </a>
                <div class="nav-links">
                    <a href="index.php" class="active"><i class="fa-solid fa-layer-group"></i> Feed</a>
                    <a href="#"><i class="fa-solid fa-server"></i> Systems</a>
                    <a href="#"><i class="fa-solid fa-network-wired"></i> Network</a>
                    <?php if ($isLoggedIn): ?>
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