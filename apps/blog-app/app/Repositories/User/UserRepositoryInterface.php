<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function get(string $order = 'id', string $sort = 'ASC');

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC');

    public function create(Request $request);

    public function find(int $id);

    public function update(Request $request, int $id);

    public function delete(int $id);
}