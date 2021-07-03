<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    function store(CommentRequest $request, Post $post)
    {
        /*$comment = $post->comments()
            ->newModelInstance($request->validated());

        $comment->user()
            ->associate(auth()->user())
            ->save();*/
        # Only 1 query
        $comment = new Comment($request->validated());

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        $comment->save();

        return back();
    }

    function destroy(Comment $comment)
    {
        $comment->delete();
        return back(); # redirect back
    }
}
