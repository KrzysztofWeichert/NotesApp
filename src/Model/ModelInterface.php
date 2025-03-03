<?php
declare(strict_types=1);

namespace App\Model;

interface ModelInterface{
    public function list(string $sortBy, string $sortOrder, int $pageSize, int $pageNumber): array;

    public function search(string $sortBy, string $sortOrder, int $pageSize, int $pageNumber, string $searchText): array;

    public function allCount(): int;

    public function searchCount(string $searchText): int;

    public function get(int $id): array;

    public function create(array $data): void;

    public function edit(array $data): void;

    public function delete(int $id): void;
}