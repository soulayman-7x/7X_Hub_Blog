<?php
session_start();
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/Admin.php';

$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? htmlspecialchars($_SESSION['username']) : 'Guest';
$currentUserId = $isLoggedIn ? htmlspecialchars($_SESSION['user_id']) : null;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$postId = intVal($_GET['id']);
$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);
$post = $admin->getPostById($postId);
$dateOnly = date('d-m-Y', strtotime($post['created_at']));
$timeOnly = date('H:i', strtotime($post['created_at']));

if (!$post) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X Hub - <?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/article.css">
    <link rel="icon" href="assets/images/logo/X-Core-V1-Wh.png">
</head>

<body>
    <!-- Header -->
    <?php include 'includes/header.php' ?>
    <main>
        <!-- ARTICLE HERO -->
        <section class="article-hero">
            <div class="container" style="max-width: 860px;">
                <div class="article-tags">
                    <span class="tag <?= htmlspecialchars($post['category_color']) ?>"><?= htmlspecialchars($post['category_name'])?></span>
                </div>

                <h1 class="article-title">
                    <?= htmlspecialchars($post['title']) ?>
                </h1>

                <div class="article-meta-bar glass-card">
                    <div class="author-block">
                        <div class="author-avatar"></div>
                        <div class="author-info">
                            <span class="author-name"><?= htmlspecialchars($post['author_name']) ?></span>
                        </div>
                    </div>

                    <div class="meta-divider"></div>

                    <div class="meta-item">
                        <span class="meta-item-label">Published</span>
                        <time class="meta-item-value" datetime="2025-06-12"><?= htmlspecialchars($dateOnly) ?></time>
                    </div>

                    <div class="meta-divider"></div>

                    <div class="meta-item">
                        <span class="meta-item-label">Time</span>
                        <span class="meta-item-value"><?= htmlspecialchars($timeOnly) ?></span>
                    </div>

                    <div class="meta-divider"></div>

                    <div class="meta-item">
                        <span class="meta-item-label">Category</span>
                        <span class="meta-item-value" style="color:<?= htmlspecialchars($post['category_color']) ?>"><?= htmlspecialchars($post['category_name']) ?></span>
                    </div>

                </div>
            </div>
        </section>

        <!-- IMAGE -->
        <div class="container" style="max-width:860px; padding-bottom:0;">
            <div class="container" style="max-width:860px; padding-bottom:0;">
                <img class="article-image" src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            </div>
        </div>

        <!-- ARTICLE BODY -->
        <article class="article-content">
            <div class="container" style="max-width:720px;">
                <div class="article-body">
                    <p>
                        <?= htmlspecialchars($post['content']) ?>
                    </p>
                    <div class="neon-line"></div>
                </div>
            </div>
        </article>
    </main>

    <!-- FOOTER -->
    <?php include 'includes/footer.php' ?>
</body>

</html>