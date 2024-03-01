<?php

namespace App\Repositories\ArticleCategory;

use App\Models\ArticleCategory;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
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
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Jsonable
    {
        try {
            $articleCategories = $this->model->orderBy($order, $sort)->paginate($perPage);
            return $articleCategories;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function create(array $data): ArticleCategory
    {
        try {
            $data['user_id'] = auth()->guard()->user()->id;
            $articleCategory = $this->model->create($data);
            return $articleCategory;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function find(int $id): ArticleCategory
    {
        try {
            $articleCategory = $this->model->findOrFail($id);
            return $articleCategory;
        }catch (ModelNotFoundException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
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
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
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
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}