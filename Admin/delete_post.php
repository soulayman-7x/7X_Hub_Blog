<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../core/config.php';
require_once '../core/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);
    
    $database = new Database();
    $db = $database->getConnection();
    
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: posts.php?status=terminated");
    } else {
        header("Location: posts.php?status=error");
    }
    exit();
} else {
    header("Location: posts.php");
    exit();
}