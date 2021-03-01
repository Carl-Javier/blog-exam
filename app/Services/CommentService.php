<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class CommentService
 * @package App\Services
 */
class CommentService extends BaseService
{
    /**
     * CommentService constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * @param array $data
     * @return Comment
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): Comment
    {
        DB::beginTransaction();

        try {
            $result = $this->model::create([
                'user_id' => auth()->user()->id,
                'article_id' => $data['article_id'],
                'content' => $data['text'],
                'is_draft' => 0,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem storing comment. Please try again.'));
        }

        DB::commit();

        return $result;
    }

}
