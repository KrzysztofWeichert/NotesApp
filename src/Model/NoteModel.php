<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class NoteModel extends AbstractModel implements ModelInterface
{
    public function create(array $data): void
    {
        $query = "INSERT INTO notes (title, description, date) VALUES (:title, :description, :created)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'created' => date('Y-m-d H:i:s')
        ]);
    }

    public function list(string $sortBy, string $sortOrder, int $pageSize, int $pageNumber): array
    {
        return $this->findBy($sortBy, $sortOrder, $pageSize, $pageNumber, null);
    }

    public function search(string $sortBy, string $sortOrder, int $pageSize, int $pageNumber, string $searchText): array
    {
        return $this->findBy($sortBy, $sortOrder, $pageSize, $pageNumber, $searchText);
    }

    public function allCount(): int
    {
        $query = "SELECT COUNT(*) FROM notes";
        return (int) $this->conn->query($query)->fetchColumn();
    }

    public function get(int $id): array
    {
        $query = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$note) {
            header('Location: /?error=error');
            exit;
        }
        return $note;
    }

    public function edit(array $data): void
    {
        $query = "UPDATE notes SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'id' => $data['id']
        ]);
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function searchCount(string $searchText): int
    {
        $query = "SELECT COUNT(*) FROM notes WHERE title LIKE :searchText";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['searchText' => "%$searchText%"]);
        return (int) $stmt->fetchColumn();
    }

    private function findBy(string $sortBy, string $sortOrder, int $pageSize, int $pageNumber, ?string $searchText): array
    {
        $offset = ($pageNumber - 1) * $pageSize;
        if (!in_array($sortBy, ['title', 'date'])) {
            $sortBy = 'title';
        }
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }
        
        $query = "SELECT id, title, date FROM notes";
        
        if ($searchText) {
            $query .= " WHERE title LIKE :searchText";
        }
        
        $query .= " ORDER BY $sortBy $sortOrder LIMIT :offset, :pageSize";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
        
        if ($searchText) {
            $stmt->bindValue(':searchText', "%$searchText%", PDO::PARAM_STR);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}