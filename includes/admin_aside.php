<?php 
$currentPage = basename($_SERVER['PHP_SELF']); 
?>

<aside class="glass-sidebar">
    <a href="dashboard.php" class="sidebar-logo">
        <i class="fa-solid fa-microchip" style="color: var(--color-7x-blue);"></i> <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>
    </a>
    
    <nav class="sidebar-nav">
        <a href="dashboard.php" class="<?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-pie"></i> Overview
        </a>
        
        <a href="posts.php" class="<?= ($currentPage == 'posts.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-database"></i> Database Logs
        </a>
        
        <a href="create_post.php" class="<?= ($currentPage == 'create_post.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-plus-terminal"></i> New Protocol
        </a>
        
        <div style="flex-grow: 1;"></div>
        
        <a href="../index.php"><i class="fa-solid fa-globe"></i> Return to Site</a>
        <a href="../logout.php" class="danger"><i class="fa-solid fa-power-off"></i> System Exit</a>
    </nav>
</aside>