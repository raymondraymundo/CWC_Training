<?php

namespace App\Repositories\ArticleCategory;

use App\Models\ArticleCategory;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    protected $model;

    public function __construct(ArticleCategory $model)
    {
        $this->model = $model;
    }

    public function get(string $order = 'id', string $sort = 'ASC'): Collection
    {
        try {
            $articleCategories = $this->model->orderBy($order, $sort)->get();
            return $articleCategories;
        }catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Collection
    {
        try {
            $articleCategories = $this->model->orderBy($order, $sort)->paginate($perPage);
            return $articleCategories;
        }catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function create(array $data): ArticleCategory
    {
        try {
            $articleCategory = $this->model->create(['name' => $data['name'], 'user_id' => auth()->user()->id]);
            return $articleCategory;
        }catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function find(int $id): ArticleCategory
    {
        try {
            $articleCategory = $this->model->findOrFail($id);
            return $articleCategory;
        }catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function update(array $data, int $id): ArticleCategory
    {
        try {
            $articleCategory = $this->model->findOrFail($id);
            $articleCategory->update($data);

            return $articleCategory;
        }catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function delete(int $id): ArticleCategory
    {
        try {
            $articleCategory = $this->model->findOrFail($id);
            $articleCategory->delete();

            return $articleCategory;
        }catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}