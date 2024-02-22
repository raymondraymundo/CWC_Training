<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function get(string $order = 'id', string $sort = 'ASC'): Collection;

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Collection;

    public function create(Request $request): User;

    public function find(int $id): User;

    public function update(Request $request, int $id): User;

    public function delete(int $id): User;
}