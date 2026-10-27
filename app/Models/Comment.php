<?php

class Comment
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getByPostId(int $postId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT comments.*, users.username
            FROM comments
            JOIN users ON users.id = comments.user_id
            WHERE comments.post_id = :post_id
            ORDER BY comments.created_at DESC
        ");

        $stmt->execute([
            'post_id' => $postId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(int $postId, int $userId, string $content): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO comments (post_id, user_id, content)
            VALUES (:post_id, :user_id, :content)
        ");

        return $stmt->execute([
            'post_id' => $postId,
            'user_id' => $userId,
            'content' => $content
        ]);
    }
}