<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Articles\StoreRequest;
use App\Http\Requests\Backend\Articles\UpdateRequest;
use App\Models\Article;
use App\Services\ArticlesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;

/**
 * Class BlogController
 * @package App\Http\Controllers\Backend
 */
class BlogController
{
    /**
     * @var ArticlesService
     */
    protected $articlesService;

    /**
     * BlogController constructor.
     * @param ArticlesService $articlesService
     */
    public function __construct(ArticlesService $articlesService)
    {
        $this->articlesService = $articlesService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.articles.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.articles.create');
    }

    /**
     * @param StoreRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->articlesService->store($request->validated(), $request);

        return redirect()->route('admin.articles.list')->withFlashSuccess(__('The article was successfully created.'));
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('backend.articles.edit', compact('article'));
    }

    /**
     * @param UpdateRequest $request
     * @param $articles
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $articles)
    {
        $this->articlesService->update($articles, $request->validated(), $request);

        return redirect()->route('admin.articles.list')->withFlashSuccess(__('The Articles was successfully updated.'));
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        return view('backend.articles.detail', ['article' => $article]);
    }
}
