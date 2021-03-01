<?php

use App\Http\Controllers\Backend\BlogController;
use App\Models\Article;
use Tabuna\Breadcrumbs\Trail;

Route::group(['prefix' => 'articles', 'as' => 'articles.', 'middleware' => ['auth', config('boilerplate.access.middleware.verified'), 'role:' . config('boilerplate.access.role.admin')]], function () {
    Route::get('/', [BlogController::class, 'index'])
        ->name('list')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Article List'), route('admin.articles.list'));
        });

    Route::get('create', [BlogController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.articles.list')
                ->push(__('Create Article'), route('admin.articles.create'));
        });

    Route::post('store', [BlogController::class, 'store'])->name('store');

    Route::get('{article}/edit', [BlogController::class, 'edit'])
        ->name('edit')
        ->breadcrumbs(function (Trail $trail, Article $article) {
            $trail->parent('admin.articles.list')
                ->push(__('Edit Article'), route('admin.articles.edit', $article))
            ;
        });

    Route::patch('{article}/update', [BlogController::class, 'update'])->name('update');
    Route::get('{article}/detail', [BlogController::class, 'show'])->name('show');
});
