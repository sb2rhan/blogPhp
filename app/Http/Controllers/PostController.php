<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * List of all posts
     */
    function index() {
        # get all queries from DB
        $posts = Post::query()
//            ->orderBy('created_at', 'desc') # or
            ->latest() # same as orderBy 'created_at'
            ->get();

        return view('models.posts.index', [
            'posts' => $posts
        ]);
    }

    function create() {
        return view('models.posts.form');
    }

    function store() {
        # Checking if html form (required) is not changed
        # Also checking db constraints
        $data = request()->validate($this->rules());

        # putting&converting data array into DB
        $post = Post::query()
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
        return view('models.posts.form', [
            'post' => $post
        ]);
    }

    function update(Post $post) {
        $data = request()->validate($this->rules($post));

        $post->update($data);
        return redirect()->route('posts.show', $post);
    }

    function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index');
    }

    /**
     * Rules to create/edit posts
     * @param Post|null $post
     * @return array
     */
    protected function rules(Post $post = null): array {
        $uniqueTitle = Rule::unique('posts', 'title');

        if ($post)
            $uniqueTitle->ignoreModel($post);

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                $uniqueTitle
            ],
            'content' => ['required', 'string', 'min:10']
        ];
    }
}
