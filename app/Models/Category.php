<?php

class Category
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
            SELECT *
            FROM categories
            ORDER BY name ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $slug): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO categories (name, slug)
            VALUES (:name, :slug)
        ");

        return $stmt->execute([
            'name' => $name,
            'slug' => $slug
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM categories WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}