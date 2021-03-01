<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Articles\StoreRequest;
use App\Http\Requests\Backend\Articles\UpdateRequest;
use App\Models\Article;
use App\Services\ArticlesService;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CommentController
 * @package App\Http\Controllers\Backend
 */
class CommentController
{
    /**
     * @var CommentService
     */
    protected $commentService;

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        $comment =  $this->commentService->store($request->all());
        return response()->json(
            [
                'avatar' => $comment->users->avatar,
                'name' => $comment->users->name,
                'content' => $comment->content,
                'date' => $comment->created_at,
            ]
        );
    }
}
