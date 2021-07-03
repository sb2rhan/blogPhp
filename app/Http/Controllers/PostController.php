<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        # needs authorization for all routes except for index and show
        $this->authorizeResource(Post::class, 'post', [
            'except' => ['index', 'show']
        ]);
    }

    /**
     * List of all posts
     */
    function index() {
        # get all queries from DB
        $posts = Post::query()
            ->latest() # same as orderBy 'created_at'
            ->with('user') # it will also query user table to prevent error from lazy loading
            ->get();

        return view('models.posts.index', [
            'posts' => $posts
        ]);
    }

    function create() {
        //$this->authorize('create', Post::class);
        return view('models.posts.form');
    }

    function store(PostRequest $request) {
        //$this->authorize('create', Post::class);
        $data = $request->validated();

        # putting&converting data array into DB
        $post = auth()->user()
            ->posts()
            ->create($data);

        # redirecting to new post page
        return redirect()->route('posts.show', $post);
    }

    /*
     * No need to give id because Laravel sees that $post is Post object
     * so it will get instance by id in web.php
     */
    function show(Post $post) {
        /*$post = Post::query()
            ->where('id', $id)
            ->firstOrFail(); # get post or exception*/
        return view('models.posts.show', [
            'post' => $post
        ]);
    }

    function edit(Post $post) {
        //$this->authorize('update', $post);
        return view('models.posts.form', [
            'post' => $post
        ]);
    }

    function update(PostRequest $request, Post $post) {
        //$this->authorize('update', $post);
        $data = $request->validated();

        $post->update($data);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post) {
        //$this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
