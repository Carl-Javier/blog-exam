<?php

namespace App\Http\Livewire\Backend;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class ArticlesTable
 * @package App\Http\Livewire\Backend
 */
class ArticlesTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'title';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Article::latest();
    }

    /**
    * @return array
    */
    public function columns(): array
    {
        return [
            Column::make(__('Title'), 'title')
                ->searchable()
                ->sortable(),
            Column::make(__('Sub Title'), 'sub_title')
                ->searchable()
                ->sortable(),
            Column::make(__('Published'), 'published_at')
                ->searchable()
                ->sortable(),
            Column::make(__('Comments'))
                ->format(function (Article $model) {
                return $this->html('<span class="badge badge-info text-2x">'.count($model->comments).'</span>');
            }),
            Column::make(__('Actions'))
                ->format(function (Article $model) {
                return view('backend.articles.includes.actions', ['article' => $model]);
            }),
        ];
    }
}
