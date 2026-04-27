<?php
session_start();
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/Admin.php';

if (isset($_SESSION['user_id'])) {
    $isLoggedIn = true;
    $username = htmlspecialchars($_SESSION['username']);
} else {
    $isLoggedIn = false;
    $username = 'Guest';
}

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);
$stats = $admin->getSystemStats();
$featuredPost = $admin->getLatestFeaturedPost();
$posts = $admin->getAllPosts();


$categories = $admin->getAllCategories();
$categories_count = [];

if ($db) {
    $catAll = "SELECT COUNT(*) FROM categories";
    $catAllStmt = $db->prepare($catAll);
    $catAllStmt->execute();
    $categories_count = $catAllStmt->fetchColumn();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X Hub - Home</title>

    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/index.css">
    <link rel="icon" href="assets/images/logo/X-Core-V1-Wh.png">
</head>

<body>
    <!-- Header -->
    <?php include 'includes/header.php' ?>

    <main>
        <!-- Hero -->
        <section class="hero">
            <div class="container" style="position:relative;">
                <p class="hero-p">Dispatches from the Digital Frontier</p>
                <h1 class="hero-title">
                    <span class="line-dim">The Future</span><br>
                    <span class="line-accent">Is Already Here.</span><br>
                    <span class="line-dim">It's Just Dark.</span>
                </h1>
                <p class="hero-subtitle">
                    Cutting-edge explorations at the intersection of technology, culture, and the shadowed corridors of
                    the networked world.
                </p>
                <div class="hero-actions">
                    <a href="#posts" class="btn btn-primary btn-arrow">Explore Posts</a>
                    <a href="contact.php" class="btn btn-ghost">Join the Network</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-value"><?= $stats['total_posts'] ?></span>
                        <span class="stat-label">Articles</span>
                    </div>

                    <div class="stat-item">
                        <span class="stat-value"><?= $stats['total_comments'] ?></span>
                        <span class="stat-label">Network Logs</span>
                    </div>

                    <div class="stat-item">
                        <span class="stat-value"><?= $categories_count ?></span>
                        <span class="stat-label">Categories</span>
                    </div>

                    <div class="stat-item">
                        <span class="stat-value"><?= $stats['total_users'] ?></span>
                        <span class="stat-label">Verified Agents</span>
                    </div>
                </div>

                <!-- Rings -->
                <div class="hero-decor">
                    <div class="hero-decor-circle"></div>
                    <div class="hero-decor-circle"></div>
                    <div class="hero-decor-circle"></div>
                    <div class="hero-decor-dot"></div>
                </div>
            </div>
        </section>

        <!-- POSTS -->
        <section class="posts-section" id="posts">
            <div class="container">
                <div class="section-header">
                    <div>
                        <p class="section-label">Latest Transmissions</p>
                        <h2 class="section-title">Recent Articles</h2>
                    </div>
                    <a href="#post-grid" class="btn btn-ghost">View All</a>
                </div>

                <!-- Featured Post -->
                <?php if ($featuredPost): ?>
                    <article class="featured-post glass-card">
                        <img class="post-image" src="<?= htmlspecialchars($featuredPost['image_path']) ?>" alt="<?= htmlspecialchars($featuredPost['title']) ?>">

                        <div class="post-body">
                            <div class="post-meta">
                                <span class="<?= htmlspecialchars($featuredPost['category_color']) ?>"><?= htmlspecialchars($featuredPost['category_name']) ?></span>
                                <span class="tag tag-purple">Featured</span>
                                <time class="post-date" datetime="<?= date('Y-m-d', strtotime($featuredPost['created_at'])) ?>">
                                    <?= date('M d, Y', strtotime($featuredPost['created_at'])) ?>
                                </time>
                            </div>

                            <h2 class="post-title">
                                <a href="article.php?id=<?= $featuredPost['id'] ?>"><?= htmlspecialchars($featuredPost['title']) ?></a>
                            </h2>

                            <p class="post-excerpt">
                                <?= htmlspecialchars(mb_substr($featuredPost['content'], 0, 180)) ?>...
                            </p>

                            <a href="article.php?id=<?= $featuredPost['id'] ?>" class="btn btn-primary btn-arrow" style="align-self:flex-start;margin-top:0.5rem;">
                                Read Full Article
                            </a>
                        </div>
                    </article>
                <?php endif; ?>
                <div class="neon-line"></div>

                <!-- Post Grid -->
                <div class="post-grid" id="post-grid">
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $item): ?>
                            <article class="post-card glass-card">
                                <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="card-image">

                                <div class="card-body">
                                    <div class="post-meta">
                                        <span class="tag <?= htmlspecialchars($item['category_color']) ?>"><?= htmlspecialchars($item['category_name']) ?></span>

                                        <time class="post-date" datetime="<?= date('Y-m-d', strtotime($item['created_at'])) ?>">
                                            <?= date('M d, Y', strtotime($item['created_at'])) ?>
                                        </time>
                                    </div>

                                    <h3 class="card-title">
                                        <a href="article.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a>
                                    </h3>

                                    <p class="card-excerpt">
                                        <?= htmlspecialchars(mb_substr($item['content'], 0, 100)) ?>...
                                    </p>

                                    <div class="card-footer">
                                        <a href="article.php?id=<?= $item['id'] ?>" class="read-more">Read More</a>
                                        <span class="post-date">Verified</span>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Newsletter -->
                <div class="newsletter-band glass-card">
                    <div class="newsletter-inner">
                        <div class="newsletter-text">
                            <p class="section-label">Signal Boost</p>
                            <h2>Stay Wired In.</h2>
                            <p>Weekly dispatches on technology, society, and the dark matter between. No noise. Pure
                                signal.</p>
                        </div>
                        <div>
                            <div class="newsletter-form">
                                <input type="email" placeholder="your@signal.net" aria-label="Email address" />
                                <button class="btn btn-primary">Subscribe</button>
                            </div>
                            <p
                                style="margin-top:0.75rem; font-size:0.78rem; font-family:var(--font-mono); color:var(--text-muted); letter-spacing:0.05em;">
                                No spam. Unsubscribe at any time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <?php include 'includes/footer.php' ?>
</body>

</html>