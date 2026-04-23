<?php
class Admin {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    // 1.
    public function getSystemStats() {
        $stats = [
            'total_posts' => 0,
            'total_comments' => 0,
            'total_users' => 0
        ];

        if ($this->conn) {
            $stats['total_posts'] = $this->conn->query('SELECT COUNT(*) FROM posts')->fetchColumn();
            $stats['total_comments'] = $this->conn->query('SELECT COUNT(*) FROM comments')->fetchColumn();
            $stats['total_users'] = $this->conn->query('SELECT COUNT(*) FROM users')->fetchColumn();
        }
        return $stats;
    }

    // 2.
    public function getAllPostsAdmin() {
        $sql = "SELECT posts.id, posts.title, posts.created_at, categories.name AS category_name, users.username AS author
                FROM posts
                LEFT JOIN categories ON posts.category_id = categories.id
                LEFT JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. 
    public function createPost($title, $content, $category_id, $user_id, $image_path) {
        $sql = "INSERT INTO posts (title, content, category_id, user_id, image_path)
        VALUES (:title, :content, :category_id, :user_id, :image_path)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':image_path', $image_path);

        return $stmt->execute();
    }

    // 4.
    public function deletePost($post_id) {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $post_id);

        return $stmt->execute();
    }

    // 5. 
    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}