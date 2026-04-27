<?php 

session_start();

require_once '../core/config.php';
require_once '../core/Database.php';
require_once '../core/Admin.php';

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);

$categories = $admin->getAllCategories();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $category_id = intval($_POST['category_id']);
    $image_url = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);
    $content = $_POST['content']; 
    $user_id = $_SESSION['user_id']; 

    if (!empty($title) && !empty($content)) {
        if ($admin->createPost($title, $content, $category_id, $user_id, $image_url)) {
            $message = "<div style='color: var(--color-7x-blue); padding: 16px; border: 1px solid var(--color-7x-blue); border-radius: 12px; margin-bottom: 24px; background: rgba(0, 212, 255, 0.1); font-family: var(--font-mono);'>> SYSTEM_LOG: Protocol published successfully.</div>";
        } else {
            $message = "<div style='color: #ff4757; padding: 16px; border: 1px solid #ff4757; border-radius: 12px; margin-bottom: 24px; background: rgba(255, 71, 87, 0.1); font-family: var(--font-mono);'>> ERROR: Failed to inject data into core.</div>";
        }
    } else {
        $message = "<div style='color: #ff4757; padding: 16px; border: 1px solid #ff4757; border-radius: 12px; margin-bottom: 24px; background: rgba(255, 71, 87, 0.1); font-family: var(--font-mono);'>> WARNING: Title and Content are mandatory.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X ADMIN // New Protocol</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/posts.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    
</head>
<body>

    <div class="admin-layout">
        
        <?php include '../includes/admin_aside.php'; ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="admin-title">
                    <h1>Deploy New Protocol</h1>
                    <p>> Injecting new operational data into the 7X Core.</p>
                </div>
            </header>

            <?php echo $message; ?>

            <div class="admin-form">
                <form action="create_post.php" method="POST">
                    
                    <div class="form-group">
                        <label>> PROTOCOL_TITLE</label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g. Advanced Quantum Encryption Methods">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="form-group">
                            <label>> SECTOR_CATEGORY</label>
                            <select name="category_id" class="form-control" required>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>> COVER_IMAGE_URL</label>
                            <input type="url" name="image_url" class="form-control" placeholder="https://images.unsplash.com/..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>> CORE_DATA (HTML Allowed)</label>
                        <textarea name="content" class="form-control" required placeholder="Initialize your log here... "></textarea>
                    </div>

                    <button type="submit" class="auth-btn" style="width: 100%; padding: 16px; font-size: 1.1rem; border: none; cursor: pointer;">
                        <i class="fa-solid fa-satellite-dish"></i> BROADCAST TO NETWORK
                    </button>
                    
                </form>
            </div>
        </main>
    </div>

</body>
</html>
