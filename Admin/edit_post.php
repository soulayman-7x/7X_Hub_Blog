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

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_protocol'])) {
    $postId = intval($_POST['post_id']);
    $title = trim($_POST['title']);
    $categoryId = intval($_POST['category_id']);
    $content = trim($_POST['content']);
    $imagePath = trim($_POST['image_path']);

    $sql = "UPDATE posts SET title = :title, category_id = :category_id, content = :content, image_path = :image_path WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category_id', $categoryId);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->bindParam(':id', $postId);

    if ($stmt->execute()) {
        $message = "<div style='color: var(--color-7x-cyan); border: 1px solid var(--color-7x-cyan); padding: 15px; margin-bottom: 25px; border-radius: var(--radius); background: rgba(0, 212, 255, 0.05); font-family: var(--font-mono);'><i class='fa-solid fa-circle-check'></i> Protocol successfully updated in the core database.</div>";
    } else {
        $message = "<div style='color: #ff4d4d; border: 1px solid #ff4d4d; padding: 15px; margin-bottom: 25px; border-radius: var(--radius); background: rgba(255, 77, 77, 0.05); font-family: var(--font-mono);'><i class='fa-solid fa-triangle-exclamation'></i> System Error: Failed to write to the database.</div>";
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: posts.php");
    exit;
}

$postId = intval($_GET['id']);
$post = $admin->getPostById($postId);

if (!$post) {
    header("Location: posts.php");
    exit;
}

$categories = $admin->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>7X Hub - Modify Protocol</title>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets//CSS/dashboard.css">
    <link rel="stylesheet" href="../assets//CSS/posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-body">

    <div class="admin-container">
        <?php include '../includes/admin_aside.php'; ?>

        <main class="admin-main">
            <header class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 class="page-title"><i class="fa-solid fa-pen-nib"></i> Modify Protocol<span>_</span></h1>
                
                <a href="posts.php" class="btn btn-ghost"><i class="fa-solid fa-arrow-left"></i> Return to Logs</a>
            </header>

            <section class="glass-panel" style="max-width: 900px;">
                
                <?= $message ?>
                
                <form action="edit_post.php?id=<?= $postId ?>" method="POST" class="admin-form">
                    
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <input type="hidden" name="update_protocol" value="1">

                    <div class="form-group">
                        <label>Protocol Title</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Sector (Category)</label>
                        <select name="category_id" class="form-control" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $post['category_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Cover Image (URL Path)</label>
                        <input type="text" name="image_path" class="form-control" value="<?= htmlspecialchars($post['image_path']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Core Data (Content)</label>
                        <textarea name="content" class="form-control" required><?= htmlspecialchars($post['content']) ?></textarea>
                    </div>

                    <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Save Modifications
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>

</body>
</html>