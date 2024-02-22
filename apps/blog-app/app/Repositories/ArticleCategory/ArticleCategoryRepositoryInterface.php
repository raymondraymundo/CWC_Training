<?php

namespace App\Repositories\ArticleCategory;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Collection;

interface ArticleCategoryRepositoryInterface
{
    public function get(string $order = 'id', string $sort = 'ASC'): Collection;

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Collection;

    public function create(array $data): ArticleCategory;

    public function find(int $id): ArticleCategory;

    public function update(array $data, int $id): ArticleCategory;

    public function delete(int $id): ArticleCategory;
}