<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $articles = Article::all();
        return view('frontend.blog', compact('articles'));
    }

    public function single($article)
    {
        $articles = Article::where('id', $article)->first();
        return view('frontend.view', compact('articles'));
    }
}
