<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function get(string $order = 'id', string $sort = 'ASC'): Collection
    {
        try {
            $articles = $this->model->orderBy($order, $sort)->get();
            return $articles;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Jsonable
    {
        try {
            $articles = $this->model->orderBy($order, $sort)->paginate($perPage);
            return $articles;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function create(Request $request): Article
    {
        try {
            $article = new Article;
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->article_category_id = $request->article_category_id;
            $article->user_id = auth()->guard()->user()->id;

            if($request->hasFile('image'))
            {
                $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('public/article/', $image);
                $article->image_path = '/storage/article/' . $image;
            }else {
                $article->image_path = '/assets/images/no-image.jpg';
            }

            $article->contents = $request->contents;
            $article->save();

            return $article;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function find(int $id): Article
    {
        try {
            $article = $this->model->findOrFail($id);
            return $article;
        }catch (ModelNotFoundException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function update(Request $request, int $id): Article
    {
        try {
            $article = $this->model->findOrFail($id);
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->article_category_id = $request->article_category_id;

            if($request->hasFile('image'))
            {
                $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('public/article/', $image);
                $article->image_path = '/storage/article/' . $image;
            }

            $article->contents = $request->contents;
            $article->save();

            return $article;
        }catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function delete(int $id): Article
    {
        try {
            $article = $this->model->findOrFail($id);
            $article->delete();

            return $article;
        }catch (ModelNotFoundException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}