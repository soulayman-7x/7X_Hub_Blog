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

$posts = $admin->getAllPostsAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>7X Hub - Database Logs</title>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/CSS/dashboard.css">
    <link rel="stylesheet" href="../assets/CSS/posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="admin-body">

    <div class="admin-container">
        <?php include '../includes/admin_aside.php'; ?>

        <main class="admin-main">
            <header class="admin-header">
                <h1 class="page-title"><i class="fa-solid fa-database"></i> Database Logs<span>_</span></h1>
                <a href="create_post.php" class="auth-btn"><i class="fa-solid fa-plus"></i> New Protocol</a>
            </header>

            <section class="glass-panel">
                <table class="protocol-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Protocol Title</th>
                            <th>Sector</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td class="mono">#<?= $post['id'] ?></td>
                                <td class="title-cell"><?= htmlspecialchars($post['title']) ?></td>
                                <td><span class="tag <?= $post['color_tag'] ?>"><?= $post['category_name'] ?></span></td>
                                <td class="mono"><?= date('Y.m.d', strtotime($post['created_at'])) ?></td>
                                <td class="actions">
                                    <a href="edit_post.php?id=<?= $post['id'] ?>" class="action-btn edit" title="Edit Protocol">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </a>
                                    <button class="action-btn delete" onclick="openDeleteModal(<?= $post['id'] ?>, '<?= addslashes($post['title']) ?>')" title="Delete Protocol">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <div id="deleteModal" class="custom-modal">
        <div class="modal-content glass-card">
            <div class="modal-header">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Security Alert</h2>
            </div>
            <p>
                Are you sure you want to terminate protocol: <br>
                <span id="protocolTitle" class="highlight"></span>?
            </p>
            <div class="modal-actions">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-ghost">Abort</button>

                <form id="deleteForm" action="delete_post.php" method="POST">
                    <input type="hidden" name="post_id" id="modalPostId">
                    <button type="submit" class="btn btn-danger">Confirm Termination</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, title) {
            document.getElementById('protocolTitle').innerText = title;
            document.getElementById('modalPostId').value = id;
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }
    </script>
</body>

</html>