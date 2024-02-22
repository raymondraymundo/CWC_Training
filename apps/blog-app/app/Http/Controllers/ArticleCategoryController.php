<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCategoryRequest;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleCategoryController extends Controller
{
    protected $articleCategory;

    public function __construct(ArticleCategoryRepositoryInterface $articleCategory)
    {
        $this->articleCategory = $articleCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $articleCategories = $this->articleCategory->get();
        return view('article_category.index', compact('articleCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('article_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleCategoryRequest $request): RedirectResponse
    {
        $this->articleCategory->create($request->except('_token', '_method'));
        return redirect()->route('article_categories.create')->with(['message' => 'Article Category was successfully created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id): View
    {
        $articleCategory = $this->articleCategory->find($id);
        return view('article_category.edit', compact('articleCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleCategoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleCategoryRequest $request, $id): RedirectResponse
    {
        $this->articleCategory->update($request->except('_token', '_method'), $id);
        return redirect()->route('article_categories.edit', ['article_category' => $id])->with(['message' => 'Article Category was successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->articleCategory->delete($id);
        return redirect()->route('article_categories.index')->with(['message' => 'Article Category was successfully deleted.']);
    }
}
