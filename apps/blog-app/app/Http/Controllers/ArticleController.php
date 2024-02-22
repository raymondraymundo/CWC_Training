<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    protected $article, $articleCategory;

    public function __construct(ArticleRepositoryInterface $article, ArticleCategoryRepositoryInterface $articleCategory)
    {
        $this->article = $article;
        $this->articleCategory = $articleCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $articles = $this->article->get();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $articleCategories = $this->articleCategory->get();
        return view('article.create', compact('articleCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->article->create($request);
        return redirect()->route('articles.create')->with(['message' => 'Article is successfully added.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id): View
    {
        $article = $this->article->find($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id): View
    {
        $article = $this->article->find($id);
        $articleCategories = $this->articleCategory->get();
        return view('article.edit', compact('article', 'articleCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, $id): RedirectResponse
    {
        $this->article->update($request, $id);
        return redirect()->route('articles.edit', ['article' => $id])->with(['message' => 'Article is successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->article->delete($id);
        return redirect()->route('articles.index', ['article' => $id])->with(['message' => 'Article is successfully deleted.']);
    }
}
