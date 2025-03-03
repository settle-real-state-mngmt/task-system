<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Responses\HttpOkResponse;

class TaskController extends Controller
{
    public function storeComments(CommentStoreRequest $request, Task $task)
    {
        $comment = Comment::create([
            ...$request->all(),
            'task_id' => $task->id
        ]);

        return HttpOkResponse::build(
            $comment,
            'Comment added successfuly'
        );
    }
}
