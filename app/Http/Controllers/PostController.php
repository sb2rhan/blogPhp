<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

        $this->uploadImage($post, $request);

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

        $this->uploadImage($post, $request);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post) {
        //$this->authorize('delete', $post);
        $this->removeImage($post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    function deleteImage(Post $post) {
        $this->authorize('update', $post);

        $this->removeImage($post);
        $post->update([
            'image_path' => null
        ]);

        return back();
    }

    function uploadImage(Post $post, PostRequest $request) {
        if (!$request->hasFile('image'))
            return;

        # store image in /storage/app/public/posts
        $path = $request->file('image')->store('public/posts');

        if ($path === false)
            throw ValidationException::withMessages([
                'image' => 'Sorry, server error. Image path problem'
            ]);

        $this->removeImage($post);
        $post->fill(['image_path' => $path])->save();
    }

    function removeImage(Post $post): bool {
        if (!$post->image_path)
            return false;
        return Storage::delete($post->image_path);
    }
}
