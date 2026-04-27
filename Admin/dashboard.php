<?php 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit(); 
}

require_once '../core/config.php';
require_once '../core/Database.php';
require_once '../core/Admin.php';

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);

$stats = $admin->getSystemStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X CORE // Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

    <div class="admin-layout">
        
        <?php include '../includes/admin_aside.php'; ?>

        <main class="admin-main">
            
            <header class="admin-header">
                <div class="admin-title">
                    <h1>Command Center</h1>
                    <p>> SYSTEM_STATUS: OPERATIONAL_</p>
                </div>
                <a href="create_post.php" class="auth-btn" style="text-decoration: none;">
                    <i class="fa-solid fa-bolt"></i> Initialize Post
                </a>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fa-solid fa-folder-tree stat-icon"></i>
                    <div class="stat-value"><?php echo $stats['total_posts']; ?></div>
                    <div class="stat-label">Active Sectors</div>
                </div>

                <div class="stat-card">
                    <i class="fa-solid fa-satellite-dish stat-icon" style="color: var(--color-7x-purple);"></i>
                    <div class="stat-value"><?php echo $stats['total_comments']; ?></div>
                    <div class="stat-label">Network Logs</div>
                </div>

                <div class="stat-card">
                    <i class="fa-solid fa-users-viewfinder stat-icon" style="color: #F3F4F6;"></i>
                    <div class="stat-value"><?php echo $stats['total_users']; ?></div>
                    <div class="stat-label">Verified Agents</div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>