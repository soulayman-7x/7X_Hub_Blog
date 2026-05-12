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

<!-- ═══════════════════════════════════════════
     MOBILE BOTTOM NAV — Visible only on ≤768px
     Uses same $currentPage & $isLoggedIn vars
     already set before this include is called.
     NO PHP LOGIC was modified.
     ═══════════════════════════════════════════ -->
<nav class="mobile-bottom-nav" aria-label="Mobile Navigation">

    <a href="index.php" class="mob-nav-item <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
        <i class="fa-solid fa-house-chimney"></i>
        <span>Home</span>
    </a>

    <a href="contact.php" class="mob-nav-item <?= ($currentPage == 'contact.php') ? 'active' : '' ?>">
        <i class="fa-solid fa-satellite-dish"></i>
        <span>Contact</span>
    </a>

    <?php if ($isLoggedIn): ?>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="Admin/dashboard.php" class="mob-nav-item <?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Admin</span>
            </a>
        <?php endif; ?>

        <a href="logout.php" class="mob-nav-item">
            <i class="fa-solid fa-power-off"></i>
            <span>Exit</span>
        </a>

    <?php else: ?>

        <a href="login.php" class="mob-nav-item <?= ($currentPage == 'login.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-fingerprint"></i>
            <span>Login</span>
        </a>

        <a href="register.php" class="mob-nav-item <?= ($currentPage == 'register.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-terminal"></i>
            <span>Join</span>
        </a>

    <?php endif; ?>

</nav>