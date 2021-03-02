<?php

namespace App\Services;

use Exception;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class ArticlesService
 * @package App\Services
 */
class ArticlesService extends BaseService
{
    /**
     * ArticlesService constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * @param array $data
     * @param $file
     * @return Article
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = [], $file): Article
    {
        DB::beginTransaction();
        try {
            $fileName = '';
            if ($file->hasFile('file')) {

                $fileName = time().'.'.$file->file->extension();

                $file->file->move(public_path('blog-image'), $fileName);
            }
            $imageUrl = $fileName;

            $articleData = [
                'user_id' => auth()->user()->id,
                'last_user_id' => auth()->user()->id,
                'title' => $data['title'],
                'sub_title' => $data['sub_title'],
                'content' => $data['content'],
                'published_at' => now(),
                'article_image' => $imageUrl
            ];

            $article = $this->model->create($articleData);

        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your article. ' . $e->getMessage()));
        }

        DB::commit();

        return $article;
    }


    /**
     * @param $article
     * @param array $data
     * @param $file
     * @return Article
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update($article, array $data = [], $file): Article
    {
        DB::beginTransaction();

        try {
            $article = $this->model::where('id', $article)->first();

            $articleData = [
                'last_user_id' => auth()->user()->id,
                'title' => $data['title'],
                'sub_title' => $data['sub_title'],
                'content' => $data['content'],
                'published_at' => now(),
            ];

            $fileName = '';
            if ($file->hasFile('file')) {

                $fileName = time().'.'.$file->file->extension();

                $file->file->move(public_path('blog-image'), $fileName);
            }
            $articleData['article_image'] = $fileName === $article->article_image ? $article->article_image: $fileName;

            $article->update($articleData);


        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this article. Please try again. ' . $e->getMessage()));
        }

        DB::commit();

        return $article;
    }


    /**
     * @param Article $article
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Article $article): bool
    {
        if ($article->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem deleting this article. Please try again.'));
    }

}
