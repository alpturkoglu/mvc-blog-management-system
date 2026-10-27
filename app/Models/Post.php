<?php

class Post
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT posts.*, users.username, categories.name AS category_name
            FROM posts
            JOIN users ON users.id = posts.user_id
            LEFT JOIN categories ON categories.id = posts.category_id
            ORDER BY posts.created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublished(): array
    {
        $stmt = $this->pdo->query("
            SELECT posts.*, users.username, categories.name AS category_name
            FROM posts
            JOIN users ON users.id = posts.user_id
            LEFT JOIN categories ON categories.id = posts.category_id
            WHERE posts.status = 'published'
            ORDER BY posts.created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated(int $limit, int $offset, bool $admin = false): array
    {
        $statusCondition = $admin ? "" : "WHERE posts.status = 'published'";

        $stmt = $this->pdo->prepare("
            SELECT posts.*, users.username, categories.name AS category_name
            FROM posts
            JOIN users ON users.id = posts.user_id
            LEFT JOIN categories ON categories.id = posts.category_id
            $statusCondition
            ORDER BY posts.created_at DESC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll(bool $admin = false): int
    {
        if ($admin) {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM posts");
        } else {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'published'");
        }

        return (int)$stmt->fetchColumn();
    }

    public function search(string $keyword): array
    {
        $stmt = $this->pdo->prepare("
            SELECT posts.*, users.username, categories.name AS category_name
            FROM posts
            JOIN users ON users.id = posts.user_id
            LEFT JOIN categories ON categories.id = posts.category_id
            WHERE posts.status = 'published'
            AND (
                posts.title LIKE :keyword
                OR posts.content LIKE :keyword
                OR users.username LIKE :keyword
            )
            ORDER BY posts.created_at DESC
        ");

        $stmt->execute([
            'keyword' => '%' . $keyword . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM posts
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }

    public function create(
        string $title,
        string $slug,
        string $content,
        int $userId,
        ?int $categoryId,
        string $status
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO posts
            (title, slug, content, user_id, category_id, status)
            VALUES
            (:title, :slug, :content, :user_id, :category_id, :status)
        ");

        return $stmt->execute([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'user_id' => $userId,
            'category_id' => $categoryId,
            'status' => $status
        ]);
    }

    public function update(
        int $id,
        string $title,
        string $content,
        ?int $categoryId,
        string $status
    ): bool {
        $stmt = $this->pdo->prepare("
            UPDATE posts
            SET title = :title,
                content = :content,
                category_id = :category_id,
                status = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'category_id' => $categoryId,
            'status' => $status
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM posts WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}