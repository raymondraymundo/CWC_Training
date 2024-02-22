<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface ArticleRepositoryInterface
{
    public function get(string $order = 'id', string $sort = 'ASC'): Collection;

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Collection;

    public function create(Request $request): Article;

    public function find(int $id): Article;

    public function update(Request $request, int $id): Article;

    public function delete(int $id): Article;
}